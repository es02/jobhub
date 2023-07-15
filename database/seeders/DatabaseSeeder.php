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

        \App\Models\User_Organisation::factory()->create([
            'name' => 'Test'
        ]);

        \App\Models\User_Role::factory()->create([
            'name' => 'Member',
            'hasMemberPerms' => True,
            'hasEmployerPerms' => False,
            'hasAdminAccess' => False
        ]);

        \App\Models\User_Role::factory()->create([
            'name' => 'Employer',
            'hasMemberPerms' => False,
            'hasEmployerPerms' => True,
            'hasAdminAccess' => False
        ]);

        \App\Models\User_Role::factory()->create([
            'name' => 'Admin',
            'hasMemberPerms' => False,
            'hasEmployerPerms' => False,
            'hasAdminAccess' => True
        ]);

        \App\Models\Application_State::factory()->create([
            'name' => 'Pending',
            'successful' => False,
            'rejected' => False
        ]);

        \App\Models\Application_State::factory()->create([
            'name' => 'Successful',
            'successful' => True,
            'rejected' => False
        ]);

        \App\Models\Application_State::factory()->create([
            'name' => 'Unsuccessful',
            'successful' => False,
            'rejected' => True
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'user_org_id' => '1',
            'user_role_id' => '3'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'user_org_id' => '1',
            'user_role_id' => '1'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'employer@example.com',
            'user_org_id' => '1',
            'user_role_id' => '2'
        ]);
    }
}
