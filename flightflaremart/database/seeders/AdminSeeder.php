<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin
        Admin::factory()->create([
            'name' => 'neerajrekwar',
            'email' => 'dev.neerajrekwar@gmail.com',
            'password' => bcrypt('nnn'),
        ]);

        // Create random admins
        // Admin::factory(5)->create();
    }
}
