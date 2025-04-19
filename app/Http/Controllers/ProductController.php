<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function getProduct($product_id, Request $request)
{
    $product_target = Peripheral::with('images')->with('category')->find($product_id);

    // Verifica si el producto no existe
    if (!$product_target) {
        abort(404, 'Producto no encontrado');
    }

    $products = Peripheral::with('images')->with('category')->get();

    $products_similars = $products
        ->filter(fn($product) => $product->category_id === $product_target->category_id)
        ->filter(fn($product) => $product->id !== $product_target->id)
        ->values();

    return Inertia::render('Products/ProductDetail', [
        'product' => $product_target,
        'productsSimilars' => $products_similars
    ]);
}

}
