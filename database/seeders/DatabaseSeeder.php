<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Harith Iqbal',
            'email' => 'manager@transtrack.com',
            'role' => 'manager',
            'password' => bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Rosmi Razak',
            'email' => 'personnel@transtrack.com',
            'role' => 'personnel',
            'password' => bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Haiqal',
            'email' => 'driver@transtrack.com',
            'role' => 'driver',
            'password' => bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Saiful',
            'email' => 'personnel2@transtrack.com',
            'role' => 'personnel',
            'password' => bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Zahid',
            'email' => 'driver2@transtrack.com',
            'role' => 'driver',
            'password' => bcrypt('password')
        ]);
    }
}
