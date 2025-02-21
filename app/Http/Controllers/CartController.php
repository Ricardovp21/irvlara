<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller {
    public function index() {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart($id) {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
            "quantity" => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function removeFromCart($id) {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }
}
