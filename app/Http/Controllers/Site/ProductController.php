<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();

        return $products;
    }

    public function show($slug)
    {
        $product = Product::where('name', $slug)->firstOrFail();
        $highlights = $product->highlights;

        $evaluations = $product->evaluations;

        $average = $evaluations->avg('stars');

        $stars = round($average);

        $product->views++;
        $product->save();

        $views = $product->views;

        $evaluationsCount = $evaluations->count();

        return Inertia::render('Show', [
            'product' => $product,
            'highlights' => $highlights,
            'evaluations' => $evaluations,
            'stars' => $stars,
            'views' => $views,
            'evaluationsCount' => $evaluationsCount
        ]);
    }
}
