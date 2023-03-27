<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $brands = ['nike', 'adidas', 'lacoste', 'gucci'];
        $sizes = ['PP', 'P', 'M', 'G', 'GG', 'XGG'];
        $colors = array();

        for ($i = 0; $i < 40; $i++) {
            $colors[] = $faker->hexcolor();
        }

        foreach ($brands as $brand) {
            $imagePath = 'public/products/' . $brand;
            $images = File::allFiles($imagePath);
            foreach ($images as $image) {
                $name = $faker->unique()->word;
                $slug = Str::slug($name);

                $imagePath = 'public/products/' . $brand . '/' . $image->getFilename();
                $imagePath = asset($imagePath);
                $imagePath = str_replace('/public', '', $imagePath);

                DB::table('products')->insert([
                    'name' => $name,
                    'slug' => $slug,
                    'image' => $imagePath,
                    'color' => implode(',', $colors),
                    // 'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
                    'price' => 00.01,
                    'description' => $faker->text($maxNbChars = 330),
                    'details' => $faker->text($maxNbChars = 200),
                    'size' => implode(',', $sizes),
                    'views' => 0,
                    'brand' => $brand,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
