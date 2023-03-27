<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Middleware\Admin;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name'      => 'Christian André Steffens',
        //     'email'     => 'oficialsteffens@hotmail.com',
        //     'password'  => Hash::make('123123123'),
        // ]);
        \App\Models\Team::factory(10)->create();

        $this->call([
            UserSeeder::class,
            TeamSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            GenderSeeder::class,
            HighlightSeeder::class,
            EvaluationSeeder::class,
            AdminSeeder::class
        ]);
    }
}
