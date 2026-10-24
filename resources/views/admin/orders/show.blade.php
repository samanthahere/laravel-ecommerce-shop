@extends('layouts.admin')
@section('content')
<a href="{{ route('admin.orders.index') }}" class="underline text-sm">&larr; Back</a>
<h1 class="text-2xl font-bold my-3">Order {{ $order->number }}</h1>
<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white p-5 rounded shadow-sm space-y-1">
        <div><strong>Name:</strong> {{ $order->name }}</div>
        <div><strong>Phone:</strong> {{ $order->phone }}</div>
        <div><strong>Email:</strong> {{ $order->email }}</div>
        <div><strong>Address:</strong> {{ $order->address }}, {{ $order->district }}</div>
        @if($order->note)<div><strong>Note:</strong> {{ $order->note }}</div>@endif
        <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="flex gap-2 pt-3">
            @csrf @method('PATCH')
            <select name="status" class="border rounded px-2 py-1">
                @foreach(\App\Models\Order::STATUSES as $s)
                    <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button class="bg-gray-900 text-white px-4 rounded">Update status</button>
        </form>
    </div>
    <div class="bg-white p-5 rounded shadow-sm">
        @foreach($order->items as $item)
            <div class="flex justify-between py-1"><span>{{ $item->name }} × {{ $item->quantity }}</span><span>৳ {{ number_format($item->price * $item->quantity) }}</span></div>
        @endforeach
        <div class="flex justify-between font-bold border-t mt-3 pt-3"><span>Total</span><span>৳ {{ number_format($order->total) }}</span></div>
    </div>
</div>
@endsection
