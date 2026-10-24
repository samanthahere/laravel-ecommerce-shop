@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="grid md:grid-cols-2 gap-8 bg-white p-6 rounded shadow-sm">
    @if($product->image_url)
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded">
    @else
        <div class="w-full h-72 bg-gray-200 rounded flex items-center justify-center text-gray-400">No image</div>
    @endif
    <div>
        <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
        <div class="text-xl mb-4">৳ {{ number_format($product->price) }}</div>
        <p class="mb-4 text-gray-600">{{ $product->description }}</p>
        @if($product->stock > 0)
            <p class="text-green-700 mb-4">In stock ({{ $product->stock }})</p>
            <form method="POST" action="{{ route('cart.add', $product) }}" class="flex gap-2">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded px-2 py-2 w-20">
                <button class="bg-gray-900 text-white px-6 py-2 rounded">Add to cart</button>
            </form>
        @else
            <p class="text-red-600">Out of stock</p>
        @endif
    </div>
</div>
@endsection
