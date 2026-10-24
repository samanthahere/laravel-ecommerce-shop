@extends('layouts.app')
@section('title', 'Order received')
@section('content')
<div class="max-w-md mx-auto text-center py-12">
    <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-neutral-900 text-white flex items-center justify-center">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    </div>
    <h1 class="text-4xl font-extrabold tracking-tighter mb-3">Order received</h1>
    <p class="text-neutral-600 mb-6">Thank you! We will contact you soon to confirm your order.</p>
    <div class="bg-white rounded-2xl py-4 mb-3 text-sm">Order number<div class="text-lg font-bold">{{ $order->number }}</div></div>
    <p class="text-xs text-neutral-500 mb-8">Payment: Cash on Delivery. A confirmation email has been sent to you.</p>
    <a href="{{ route('shop.index') }}" class="inline-block bg-neutral-900 text-white px-8 py-3.5 rounded-full font-semibold hover:bg-neutral-700 transition">Continue shopping</a>
</div>
@endsection
