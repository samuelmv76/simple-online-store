<?php

namespace App\Http\Controllers;

use App\Enums\CartStatus;
use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class CartController extends Controller
{
    public function show(Request $request)
    {
        return Inertia::render('Cart/Cart');
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => ['required', new Enum(CartStatus::class)],
            'products' => 'required|array|min:1',
            'products.*.id_product' => 'required|integer|exists:peripherals,id',
            'products.*.count' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0'
        ]);

        $current_user = $request->user();

        $cart = new Cart();
        $cart->status = $request->status;
        $cart->user_id = $current_user->id;
        $cart->save();

        $products = [];

        foreach ($request->products as $product) {
            $cart_product = new CartProduct();
            $cart_product->peripheral_id = $product['id_product'];
            $cart_product->count_product = $product['count'];
            $cart_product->price_product = $product['price'];
            $cart_product->cart_id = $cart->id;
            $cart_product->save();

            $products[] = $cart_product;
        }

        return response()->json([
            'message' => 'Orden realizada con éxito',
            'data' => [
                'cart' => $cart,
                'cart_products' => $products
            ]
        ], 201);
    }

    public function orders(Request $request)
    {
        $current_user = $request->user();

        $carts = Cart::where('user_id', $current_user->id)
            ->with('cartProduct.peripheral.images', 'cartProduct.peripheral.category')
            ->get();

        return Inertia::render('Order/Order', [
            'carts' => $carts,
            'user' => $current_user->only(['id', 'name', 'email'])
        ]);
    }

    public function getOrderById($cart_id, Request $request)
    {
        $current_user = $request->user();

        $cart = Cart::where('user_id', $current_user->id)
            ->where('id', $cart_id)
            ->with('cartProduct.peripheral.images', 'cartProduct.peripheral.category')
            ->first();

        if (!$cart) {
            return abort(404, 'Orden no encontrada');
        }

        return Inertia::render('Order/Detail', ['cart' => $cart]);
    }
}
