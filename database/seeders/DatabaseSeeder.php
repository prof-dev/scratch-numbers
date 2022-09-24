<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::factory()->create([
            'id' => 1,
            'name' => 'ADMIN',
        ]);
        \App\Models\Role::factory()->create([
            'id' => 2,
            'name' => 'READ_AND_WRITE',
        ]);
        \App\Models\Role::factory()->create([
            'id' => 3,
            'name' => 'READ',
        ]);
        \App\Models\Role::factory()->create([
            'id' => 4,
            'name' => 'API_CONSUMER',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('1234567890'),
            'role_id' => 1,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@readandwrite.com',
            'password' => bcrypt('1234567890'),
            'role_id' => 2,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@read.com',
            'password' => bcrypt('1234567890'),
            'role_id' => 3,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@api.com',
            'password' => bcrypt('1234567890'),
            'role_id' => 4,
        ]);
        \App\Models\Company::factory()->create([
            'name' => 'TransSudan',
            'code' => 'TSD',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@company.com',
            'password' => bcrypt('1234567890'),
            'role_id' => 2,
            'company_id' => 1
        ]);
    }
}
