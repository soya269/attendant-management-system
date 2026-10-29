<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create sample departments
        Department::create(['name' => 'Customer Support']);
        Department::create(['name' => 'Front Desk']);
        Department::create(['name' => 'Human Resources']);
        Department::create(['name' => 'Operations']);

        // 2. Create the Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Change this password if you like
        ]);
    }
}