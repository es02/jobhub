<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\UserRole::factory()->create([
            'name' => 'Member',
            'hasMemberPerms' => True,
            'hasEmployerPerms' => False,
            'hasAdminAccess' => False
        ]);

        \App\Models\UserRole::factory()->create([
            'name' => 'Employer',
            'hasMemberPerms' => False,
            'hasEmployerPerms' => True,
            'hasAdminAccess' => False
        ]);

        \App\Models\UserRole::factory()->create([
            'name' => 'Member',
            'hasMemberPerms' => False,
            'hasEmployerPerms' => False,
            'hasAdminAccess' => True
        ]);

        \App\Models\ApplicationState::factory()->create([
            'name' => 'Pending',
            'successful' => False,
            'rejected' => False
        ]);

        \App\Models\ApplicationState::factory()->create([
            'name' => 'Successful',
            'successful' => True,
            'rejected' => False
        ]);

        \App\Models\ApplicationState::factory()->create([
            'name' => 'Unsuccessful',
            'successful' => False,
            'rejected' => True
        ]);
    }
}
