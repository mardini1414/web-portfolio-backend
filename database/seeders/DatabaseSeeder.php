<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::insert([
            'name' => 'Mardini',
            'email' => 'mardini1414@gmail.com',
            'password' => Hash::make('kompronk14'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
