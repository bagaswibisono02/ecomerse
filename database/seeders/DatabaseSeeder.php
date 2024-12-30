<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Administrator',
            'email' => 'administrator@gmail.com',
            'password'=> bcrypt('Fuka_Wata123'),
            'contact'=>'08788789892',
            'hak_akses'=>'Administrator'
        ]);
    }
}
