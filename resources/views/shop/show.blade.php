@extends('layouts.app')
@section('title', $product->name)
@section('content')
<a href="{{ route('shop.index') }}#products" class="text-sm text-neutral-500 hover:text-neutral-900 transition">← Back to shop</a>

<div class="grid md:grid-cols-2 gap-8 md:gap-16 mt-6">
    <div class="aspect-[4/5] rounded-[2rem] overflow-hidden bg-stone-200">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
        @endif
    </div>

    <div class="flex flex-col justify-center">
        @if($product->category)<span class="text-xs font-semibold uppercase tracking-[0.25em] text-neutral-500 mb-4">{{ $product->category->name }}</span>@endif
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tighter leading-tight mb-4">{{ $product->name }}</h1>
        <div class="text-2xl font-semibold mb-6">৳ {{ number_format($product->price) }}</div>
        <p class="text-neutral-600 leading-relaxed mb-8">{{ $product->description }}</p>

        @if($product->stock > 0)
            <form method="POST" action="{{ route('cart.add', $product) }}" class="flex gap-3 mb-3">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="bg-white rounded-full px-4 py-3.5 w-24 text-center focus:outline-none focus:ring-2 focus:ring-neutral-900">
                <button class="flex-1 bg-neutral-900 hover:bg-neutral-700 text-white font-semibold py-3.5 rounded-full transition">Add to cart</button>
            </form>
            <p class="text-xs text-neutral-500 mb-8">{{ $product->stock }} in stock</p>
        @else
            <p class="font-semibold mb-8">Sold out</p>
        @endif

        <div class="border-t border-neutral-300 pt-6 grid grid-cols-2 gap-4 text-sm text-neutral-600">
            <div><div class="font-semibold text-neutral-900">Cash on Delivery</div>Pay when it arrives</div>
            <div><div class="font-semibold text-neutral-900">Delivery</div>All over Bangladesh</div>
        </div>
    </div>
</div>
@endsection
