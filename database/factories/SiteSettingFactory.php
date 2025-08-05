<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['text', 'textarea', 'boolean', 'float', 'json'];
        $groups = ['general', 'company', 'seo'];
        
        return [
            'key' => fake()->unique()->slug(),
            'value' => fake()->sentence(),
            'type' => fake()->randomElement($types),
            'group' => fake()->randomElement($groups),
            'description' => fake()->sentence()
        ];
    }

    /**
     * Company setting state
     */
    public function company(): static
    {
        return $this->state(fn (array $attributes) => [
            'group' => 'company',
            'key' => 'company_' . fake()->word(),
            'value' => fake()->company()
        ]);
    }

    /**
     * SEO setting state
     */
    public function seo(): static
    {
        return $this->state(fn (array $attributes) => [
            'group' => 'seo',
            'key' => 'seo_' . fake()->word(),
            'type' => 'boolean',
            'value' => fake()->boolean() ? '1' : '0'
        ]);
    }

    /**
     * Boolean setting state
     */
    public function boolean(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'boolean',
            'value' => fake()->boolean() ? '1' : '0'
        ]);
    }
}
