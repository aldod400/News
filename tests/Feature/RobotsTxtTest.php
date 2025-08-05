<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\RobotsTxt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RobotsTxtTest extends TestCase
{
    use RefreshDatabase;
    
    protected User $superAdmin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create roles
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Writer']);
        
        // Create Super Admin user
        $this->superAdmin = User::factory()->create();
        $this->superAdmin->assignRole('Super Admin');
        
        // Create regular user
        $this->regularUser = User::factory()->create();
        $this->regularUser->assignRole('Writer');
    }

    /** @test */
    public function robots_txt_route_returns_content()
    {
        // Create an active robots.txt
        $robotsTxt = RobotsTxt::factory()->active()->create([
            'content' => "User-agent: *\nDisallow: /admin/"
        ]);

        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertSee('User-agent: *');
        $response->assertSee('Disallow: /admin/');
    }

    /** @test */
    public function super_admin_can_access_robots_txt_management()
    {
        $this->actingAs($this->superAdmin);

        $response = $this->get(route('admin.robots-txt.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function regular_user_cannot_access_robots_txt_management()
    {
        $this->actingAs($this->regularUser);

        $response = $this->get(route('admin.robots-txt.index'));
        $response->assertStatus(403);
    }

    /** @test */
    public function super_admin_can_create_robots_txt()
    {
        $this->actingAs($this->superAdmin);

        $content = "User-agent: *\nDisallow: /private/\nAllow: /";

        $response = $this->post(route('admin.robots-txt.store'), [
            'content' => $content
        ]);

        $response->assertRedirect(route('admin.robots-txt.index'));
        $this->assertDatabaseHas('robots_txt', [
            'content' => $content,
            'is_active' => false
        ]);
    }

    /** @test */
    public function super_admin_can_set_robots_txt_as_active()
    {
        $this->actingAs($this->superAdmin);

        $robotsTxt = RobotsTxt::factory()->create(['is_active' => false]);

        $response = $this->patch(route('admin.robots-txt.set-active', $robotsTxt));

        $response->assertRedirect(route('admin.robots-txt.index'));
        $this->assertTrue($robotsTxt->fresh()->is_active);
    }

    /** @test */
    public function setting_robots_txt_as_active_deactivates_others()
    {
        $this->actingAs($this->superAdmin);

        $activeRobotsTxt = RobotsTxt::factory()->active()->create();
        $newRobotsTxt = RobotsTxt::factory()->create(['is_active' => false]);

        $this->patch(route('admin.robots-txt.set-active', $newRobotsTxt));

        $this->assertTrue($newRobotsTxt->fresh()->is_active);
        $this->assertFalse($activeRobotsTxt->fresh()->is_active);
    }

    /** @test */
    public function cannot_delete_active_robots_txt()
    {
        $this->actingAs($this->superAdmin);

        $activeRobotsTxt = RobotsTxt::factory()->active()->create();

        $response = $this->delete(route('admin.robots-txt.destroy', $activeRobotsTxt));

        $response->assertRedirect(route('admin.robots-txt.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('robots_txt', ['id' => $activeRobotsTxt->id]);
    }

    /** @test */
    public function can_delete_inactive_robots_txt()
    {
        $this->actingAs($this->superAdmin);

        $inactiveRobotsTxt = RobotsTxt::factory()->create(['is_active' => false]);

        $response = $this->delete(route('admin.robots-txt.destroy', $inactiveRobotsTxt));

        $response->assertRedirect(route('admin.robots-txt.index'));
        $this->assertDatabaseMissing('robots_txt', ['id' => $inactiveRobotsTxt->id]);
    }

    /** @test */
    public function robots_txt_content_validation_works()
    {
        $this->actingAs($this->superAdmin);

        // Test with invalid content (no User-agent)
        $response = $this->post(route('admin.robots-txt.store'), [
            'content' => 'Disallow: /admin/'
        ]);

        $response->assertSessionHasErrors('content');
    }

    /** @test */
    public function get_active_robots_txt_helper_works()
    {
        // Test with no active robots.txt
        $content = RobotsTxt::getActiveContent();
        $this->assertEquals("User-agent: *\nDisallow:", $content);

        // Test with active robots.txt
        $activeRobotsTxt = RobotsTxt::factory()->active()->create([
            'content' => "User-agent: *\nDisallow: /admin/"
        ]);

        $content = RobotsTxt::getActiveContent();
        $this->assertEquals("User-agent: *\nDisallow: /admin/", $content);
    }

    protected function tearDown(): void
    {
        // Clean up any created robots.txt file
        $robotsPath = public_path('robots.txt');
        if (File::exists($robotsPath)) {
            File::delete($robotsPath);
        }

        parent::tearDown();
    }
}
