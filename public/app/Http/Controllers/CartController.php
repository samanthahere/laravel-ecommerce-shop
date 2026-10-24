<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        [$items, $total] = Cart::items();
        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->input('quantity', 1));
        $cart = Cart::raw();
        $cart[$product->id] = min(($cart[$product->id] ?? 0) + $qty, $product->stock);

        if ($product->stock < 1) {
            return back()->withErrors(['cart' => 'This product is out of stock.']);
        }

        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $qty = (int) $request->input('quantity', 1);
        $cart = Cart::raw();

        if ($qty < 1) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = min($qty, $product->stock);
        }

        session(['cart' => $cart]);
        return back();
    }

    public function remove(Product $product)
    {
        $cart = Cart::raw();
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return back();
    }
}
