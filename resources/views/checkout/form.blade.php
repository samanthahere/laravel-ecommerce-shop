@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
@php $field = 'w-full bg-white rounded-2xl px-5 py-3.5 focus:outline-none focus:ring-2 focus:ring-neutral-900 placeholder:text-neutral-400'; @endphp
<h1 class="text-4xl font-extrabold tracking-tighter mb-8">Checkout</h1>

<div class="grid lg:grid-cols-5 gap-8">
    <form method="POST" action="{{ route('checkout.store') }}" class="lg:col-span-3 space-y-4" onsubmit="this.querySelector('button').disabled = true">
        @csrf
        <h2 class="font-bold text-lg">Delivery details</h2>
        <input name="name" value="{{ old('name') }}" placeholder="Full name" class="{{ $field }}" required>
        <div class="grid md:grid-cols-2 gap-4">
            <input name="phone" value="{{ old('phone') }}" placeholder="Phone (01XXXXXXXXX)" class="{{ $field }}" required>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="{{ $field }}" required>
        </div>
        <textarea name="address" rows="2" placeholder="Full address" class="{{ $field }}" required>{{ old('address') }}</textarea>
        <input name="district" value="{{ old('district') }}" placeholder="District" class="{{ $field }}" required>
        <textarea name="note" rows="2" placeholder="Note (optional)" class="{{ $field }}">{{ old('note') }}</textarea>
        <div class="bg-white rounded-2xl px-5 py-3.5 text-sm text-neutral-600">Payment: <strong class="text-neutral-900">Cash on Delivery</strong></div>
        <button class="w-full bg-neutral-900 hover:bg-neutral-700 disabled:opacity-50 text-white font-semibold py-4 rounded-full transition">Place order</button>
    </form>

    <div class="lg:col-span-2 bg-white rounded-3xl p-7 h-fit">
        <h2 class="font-bold text-lg mb-5">Your order</h2>
        @foreach($items as $i)
            <div class="flex justify-between gap-3 py-2 text-sm">
                <span>{{ $i['product']->name }} <span class="text-neutral-400">× {{ $i['qty'] }}</span></span>
                <span class="whitespace-nowrap">৳ {{ number_format($i['subtotal']) }}</span>
            </div>
        @endforeach
        <div class="flex justify-between font-bold text-lg border-t border-neutral-200 mt-4 pt-4"><span>Total</span><span>৳ {{ number_format($total) }}</span></div>
    </div>
</div>
@endsection
