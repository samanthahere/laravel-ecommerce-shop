@extends('layouts.app')
@section('title', 'Order received')
@section('content')
<div class="bg-white p-8 rounded shadow-sm text-center">
    <h1 class="text-2xl font-bold mb-2">Thank you! Your order is received.</h1>
    <p class="mb-2">Order number: <strong>{{ $order->number }}</strong></p>
    <p class="mb-4 text-gray-600">We will contact you soon to confirm. Payment: Cash on Delivery.</p>
    <a href="{{ route('shop.index') }}" class="underline">Continue shopping</a>
</div>
@endsection
