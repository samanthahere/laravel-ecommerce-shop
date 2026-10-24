@extends('layouts.admin')
@section('content')
@php
    $colors = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'confirmed' => 'bg-blue-100 text-blue-800',
        'shipped' => 'bg-purple-100 text-purple-800',
        'delivered' => 'bg-green-100 text-green-800',
        'cancelled' => 'bg-red-100 text-red-800',
    ];
@endphp
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded-2xl shadow-sm"><div class="text-sm text-gray-500">Total orders</div><div class="text-3xl font-bold">{{ $stats['total'] }}</div></div>
    <div class="bg-white p-5 rounded-2xl shadow-sm"><div class="text-sm text-gray-500">Pending</div><div class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</div></div>
    <div class="bg-white p-5 rounded-2xl shadow-sm"><div class="text-sm text-gray-500">Total sales</div><div class="text-3xl font-bold text-green-700">৳ {{ number_format($stats['sales']) }}</div></div>
</div>

<div class="flex flex-wrap gap-2 mb-4 text-sm">
    <a href="{{ route('admin.orders.index') }}" class="px-3 py-1 border rounded-full {{ request('status') ? 'bg-white' : 'bg-gray-900 text-white' }}">All</a>
    @foreach(\App\Models\Order::STATUSES as $s)
        <a href="{{ route('admin.orders.index', ['status' => $s]) }}" class="px-3 py-1 border rounded-full {{ request('status') === $s ? 'bg-gray-900 text-white' : 'bg-white' }}">{{ ucfirst($s) }}</a>
    @endforeach
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
<table class="w-full text-left text-sm">
    <thead class="bg-gray-50 text-gray-500"><tr><th class="p-3">Order</th><th>Customer</th><th>Phone</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody>
    @forelse($orders as $o)
        <tr class="border-t hover:bg-gray-50">
            <td class="p-3"><a href="{{ route('admin.orders.show', $o) }}" class="font-medium underline">{{ $o->number }}</a></td>
            <td>{{ $o->name }}</td><td>{{ $o->phone }}</td>
            <td>৳ {{ number_format($o->total) }}</td>
            <td><span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $colors[$o->status] ?? 'bg-gray-100' }}">{{ ucfirst($o->status) }}</span></td>
            <td>{{ $o->created_at->format('d M Y, h:i A') }}</td>
        </tr>
    @empty
        <tr><td class="p-3" colspan="6">No orders yet.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="mt-4">{{ $orders->links() }}</div>
@endsection
