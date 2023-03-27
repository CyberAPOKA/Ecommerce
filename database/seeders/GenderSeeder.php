<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            'Masculino', 'Feminino', 'Unissex'
        ];

        foreach ($genders as $gender) {
            DB::table('genders')->insert([
                'name' => $gender,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
