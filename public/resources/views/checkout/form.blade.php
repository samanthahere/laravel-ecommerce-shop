@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<h1 class="text-2xl font-bold mb-4">Checkout</h1>
<div class="grid md:grid-cols-2 gap-6">
    <form method="POST" action="{{ route('checkout.store') }}" class="bg-white p-6 rounded shadow-sm space-y-3">
        @csrf
        <input name="name" value="{{ old('name') }}" placeholder="Full name" class="border rounded w-full px-3 py-2" required>
        <input name="phone" value="{{ old('phone') }}" placeholder="Phone (01XXXXXXXXX)" class="border rounded w-full px-3 py-2" required>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="border rounded w-full px-3 py-2" required>
        <textarea name="address" placeholder="Full address" class="border rounded w-full px-3 py-2" required>{{ old('address') }}</textarea>
        <input name="district" value="{{ old('district') }}" placeholder="District" class="border rounded w-full px-3 py-2" required>
        <textarea name="note" placeholder="Note (optional)" class="border rounded w-full px-3 py-2">{{ old('note') }}</textarea>
        <p class="text-sm text-gray-600">Payment: Cash on Delivery</p>
        <button class="bg-gray-900 text-white px-6 py-2 rounded w-full">Place order</button>
    </form>
    <div class="bg-white p-6 rounded shadow-sm h-fit">
        <h2 class="font-bold mb-3">Order summary</h2>
        @foreach($items as $i)
            <div class="flex justify-between py-1"><span>{{ $i['product']->name }} × {{ $i['qty'] }}</span><span>৳ {{ number_format($i['subtotal']) }}</span></div>
        @endforeach
        <div class="flex justify-between font-bold border-t mt-3 pt-3"><span>Total</span><span>৳ {{ number_format($total) }}</span></div>
    </div>
</div>
@endsection
