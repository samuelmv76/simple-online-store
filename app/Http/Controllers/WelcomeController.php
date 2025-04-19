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
        $productsPage = Peripheral::with('images')->with('category')->orderBy('id')->paginate(8);
        $categories = Category::all();
        $products = Peripheral::with('images')->with('category')->get();

        return Inertia::render('Welcome', [
            'productsPage' => $productsPage,
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
