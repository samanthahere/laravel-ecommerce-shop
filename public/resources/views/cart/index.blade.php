@extends('layouts.app')
@section('title', 'Your cart')
@section('content')
<h1 class="text-2xl font-bold mb-4">Your cart</h1>
@if($items)
<div class="bg-white rounded shadow-sm overflow-x-auto">
<table class="w-full text-left">
    <thead class="border-b"><tr><th class="p-3">Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
    <tbody>
    @foreach($items as $i)
        <tr class="border-b">
            <td class="p-3">{{ $i['product']->name }}</td>
            <td>৳ {{ number_format($i['product']->price) }}</td>
            <td>
                <form method="POST" action="{{ route('cart.update', $i['product']) }}" class="flex gap-1">
                    @csrf @method('PATCH')
                    <input type="number" name="quantity" value="{{ $i['qty'] }}" min="0" class="border rounded w-16 px-2 py-1">
                    <button class="text-sm underline">Update</button>
                </form>
            </td>
            <td>৳ {{ number_format($i['subtotal']) }}</td>
            <td>
                <form method="POST" action="{{ route('cart.remove', $i['product']) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-600 text-sm">Remove</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="mt-4 text-right">
    <div class="text-xl font-bold mb-3">Total: ৳ {{ number_format($total) }}</div>
    <a href="{{ route('checkout.create') }}" class="bg-gray-900 text-white px-6 py-2 rounded">Checkout</a>
</div>
@else
    <p>Your cart is empty. <a href="{{ route('shop.index') }}" class="underline">Continue shopping</a></p>
@endif
@endsection
