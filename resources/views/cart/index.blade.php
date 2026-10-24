@extends('layouts.app')
@section('title', 'Your cart')
@section('content')
<h1 class="text-4xl font-extrabold tracking-tighter mb-8">Your cart</h1>

@if($items)
<div class="grid lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 divide-y divide-neutral-300 border-y border-neutral-300">
        @foreach($items as $i)
        <div class="py-5 flex gap-4">
            <div class="w-24 h-28 rounded-2xl overflow-hidden bg-stone-200 shrink-0">
                @if($i['product']->image_url)<img src="{{ $i['product']->image_url }}" class="w-full h-full object-cover" alt="">@endif
            </div>
            <div class="flex-1 min-w-0 flex flex-col justify-between">
                <div>
                    <div class="font-semibold">{{ $i['product']->name }}</div>
                    <div class="text-sm text-neutral-500">৳ {{ number_format($i['product']->price) }}</div>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <form method="POST" action="{{ route('cart.update', $i['product']) }}" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="number" name="quantity" value="{{ $i['qty'] }}" min="0" class="bg-white rounded-full w-20 px-3 py-1.5 text-center text-sm">
                        <button class="text-sm underline hover:opacity-60">Update</button>
                    </form>
                    <form method="POST" action="{{ route('cart.remove', $i['product']) }}">
                        @csrf @method('DELETE')
                        <button class="text-sm text-neutral-500 hover:text-red-600">Remove</button>
                    </form>
                </div>
            </div>
            <div class="font-semibold whitespace-nowrap">৳ {{ number_format($i['subtotal']) }}</div>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-3xl p-7 h-fit">
        <h2 class="font-bold text-lg mb-5">Summary</h2>
        <div class="flex justify-between text-sm text-neutral-600 mb-2"><span>Subtotal</span><span>৳ {{ number_format($total) }}</span></div>
        <div class="flex justify-between text-sm text-neutral-600 mb-5"><span>Payment</span><span>Cash on Delivery</span></div>
        <div class="flex justify-between text-xl font-bold border-t border-neutral-200 pt-5 mb-6"><span>Total</span><span>৳ {{ number_format($total) }}</span></div>
        <a href="{{ route('checkout.create') }}" class="block text-center bg-neutral-900 hover:bg-neutral-700 text-white font-semibold py-3.5 rounded-full transition">Checkout</a>
    </div>
</div>
@else
<div class="text-center py-20">
    <p class="text-neutral-500 mb-6">Your cart is empty.</p>
    <a href="{{ route('shop.index') }}" class="inline-block bg-neutral-900 text-white px-8 py-3.5 rounded-full font-semibold hover:bg-neutral-700 transition">Continue shopping</a>
</div>
@endif
@endsection
