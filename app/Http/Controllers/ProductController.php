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
        $product_target = Peripheral::with('images', 'category')->find($product_id);

        if (!$product_target) {
            abort(404, 'Producto no encontrado');
        }

        $products_similars = Peripheral::with('images', 'category')
            ->where('category_id', $product_target->category_id)
            ->where('id', '!=', $product_target->id)
            ->get();

        return Inertia::render('Products/ProductDetail', [
            'product' => $product_target,
            'productsSimilars' => $products_similars
        ]);
    }

    public function adminIndex()
    {
        $products = Peripheral::with('images', 'category')->get();

        return Inertia::render('Admin/ManagePeripherals', [
            'peripherals' => $products
        ]);
    }
    public function updateStock(Request $request, $id)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0'
        ]);
    
        $product = Peripheral::findOrFail($id);
        $product->stock = $validated['stock'];
        $product->save();
    
        return back(303); // Esto evita que Inertia haga redirección extraña
    }       
}
