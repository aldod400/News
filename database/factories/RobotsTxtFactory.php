<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RobotsTxt>
 */
class RobotsTxtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->generateRobotsTxtContent(),
            'is_active' => false,
        ];
    }

    /**
     * Generate sample robots.txt content
     */
    private function generateRobotsTxtContent()
    {
        $userAgents = ['*', 'Googlebot', 'Bingbot', 'Slurp'];
        $disallowPaths = ['/admin/', '/private/', '/temp/', '/backup/'];
        
        $content = "User-agent: " . fake()->randomElement($userAgents) . "\n";
        $content .= "Disallow: " . fake()->randomElement($disallowPaths) . "\n";
        
        if (fake()->boolean(70)) {
            $content .= "Allow: /\n";
        }
        
        if (fake()->boolean(80)) {
            $content .= "\nSitemap: " . url('/sitemap.xml');
        }
        
        return $content;
    }

    /**
     * Indicate that the robots.txt should be active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}
