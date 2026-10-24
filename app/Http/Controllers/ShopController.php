<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->category));
        }
        if ($request->filled('q')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->q) . '%']);
        }

        return view('shop.index', [
            'products' => $query->latest()->paginate(12)->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
