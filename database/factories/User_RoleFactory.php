<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_Role>
 */
class User_RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->jobTitle(),
            'hasMemberPerms' => fake()->boolean(),
            'hasEmployerPerms' => fake()->boolean(),
            'hasAdminAccess' => fake()->boolean()
        ];
    }
}
