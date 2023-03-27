<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            foreach ($products as $product) {
                Evaluation::factory()->create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'stars' => rand(1, 5),
                ]);
            }
        }
    }
}
