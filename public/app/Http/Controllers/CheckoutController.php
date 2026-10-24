<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Mail\OrderPlacedAdmin;
use App\Models\Order;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create()
    {
        [$items, $total] = Cart::items();
        if (!$items) {
            return redirect()->route('shop.index')->withErrors(['cart' => 'Your cart is empty.']);
        }
        return view('checkout.form', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
            'email' => 'required|email|max:150',
            'address' => 'required|string|max:500',
            'district' => 'required|string|max:60',
            'note' => 'nullable|string|max:500',
        ], [
            'phone.regex' => 'Enter a valid Bangladeshi phone number (e.g. 01712345678).',
        ]);

        [$items] = Cart::items();
        if (!$items) {
            return redirect()->route('shop.index')->withErrors(['cart' => 'Your cart is empty.']);
        }

        // Save order + items + reduce stock. All-or-nothing (transaction).
        try {
            $order = DB::transaction(function () use ($data) {
                [$items, $total] = Cart::items();

                $order = Order::create($data + [
                    'number' => 'ORD-' . strtoupper(Str::random(8)),
                    'total' => $total,
                    'status' => 'pending',
                ]);

                foreach ($items as $i) {
                    $p = Product::lockForUpdate()->find($i['product']->id);
                    if ($p->stock < $i['qty']) {
                        throw new \RuntimeException("Sorry, {$p->name} does not have enough stock.");
                    }
                    $p->decrement('stock', $i['qty']);
                    $order->items()->create([
                        'product_id' => $p->id,
                        'name' => $p->name,
                        'price' => $p->price,
                        'quantity' => $i['qty'],
                    ]);
                }
                return $order;
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->withErrors(['cart' => $e->getMessage()]);
        }

        Cart::clear();

        // Emails. If mail fails, the order is still saved (we only log the error).
        try {
            Mail::to(config('shop.admin_email'))->send(new OrderPlacedAdmin($order));
        } catch (\Throwable $e) {
            Log::error('Owner order mail failed: ' . $e->getMessage());
        }
        try {
            Mail::to($order->email)->send(new OrderConfirmation($order));
        } catch (\Throwable $e) {
            Log::error('Customer order mail failed: ' . $e->getMessage());
        }

        return redirect()->route('checkout.success', $order->number);
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
