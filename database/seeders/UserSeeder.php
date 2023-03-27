<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        User::create([
            'name' => 'Christian André Steffens',
            'email' => 'oficialsteffens@hotmail.com',
            'password'      => Hash::make('123123123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
