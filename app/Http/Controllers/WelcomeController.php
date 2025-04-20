<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function show(Request $request)
    {
        $productsPage = Peripheral::with('images', 'category')->orderBy('id')->paginate(8);
        $products = Peripheral::with('images', 'category')->get();
        $categories = Category::all();

        return Inertia::render('Welcome', [
            'productsPage' => $productsPage,
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
