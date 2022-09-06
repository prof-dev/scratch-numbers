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
            'name' => 'APT_CONSUMER',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('1234567890'),
            'role_id' => 1,
        ]);
        \App\Models\Company::factory()->create([
            'name' => 'TransSudan',
            'code' => 'TSD',
        ]);
    }
}
