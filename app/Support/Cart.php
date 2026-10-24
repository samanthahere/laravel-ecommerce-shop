<?php

namespace App\Support;

use App\Models\Product;

/** Session-based cart: session('cart') = [product_id => quantity] */
class Cart
{
    public static function raw(): array
    {
        return session('cart', []);
    }

    /** @return array [items, total] */
    public static function items(): array
    {
        $raw = self::raw();
        $products = Product::whereIn('id', array_keys($raw))->get()->keyBy('id');
        $items = [];
        $total = 0;

        foreach ($raw as $id => $qty) {
            if (!isset($products[$id])) continue;
            $p = $products[$id];
            $sub = $p->price * $qty;
            $total += $sub;
            $items[] = ['product' => $p, 'qty' => $qty, 'subtotal' => $sub];
        }
        return [$items, $total];
    }

    public static function count(): int
    {
        return array_sum(self::raw());
    }

    public static function clear(): void
    {
        session()->forget('cart');
    }
}
