@extends('layouts.admin')
@section('content')
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow-sm"><div class="text-sm text-gray-500">Total orders</div><div class="text-2xl font-bold">{{ $stats['total'] }}</div></div>
    <div class="bg-white p-4 rounded shadow-sm"><div class="text-sm text-gray-500">Pending</div><div class="text-2xl font-bold">{{ $stats['pending'] }}</div></div>
    <div class="bg-white p-4 rounded shadow-sm"><div class="text-sm text-gray-500">Total sales</div><div class="text-2xl font-bold">৳ {{ number_format($stats['sales']) }}</div></div>
</div>

<div class="flex gap-2 mb-4 text-sm">
    <a href="{{ route('admin.orders.index') }}" class="px-3 py-1 border rounded bg-white">All</a>
    @foreach(\App\Models\Order::STATUSES as $s)
        <a href="{{ route('admin.orders.index', ['status' => $s]) }}" class="px-3 py-1 border rounded {{ request('status') === $s ? 'bg-gray-900 text-white' : 'bg-white' }}">{{ ucfirst($s) }}</a>
    @endforeach
</div>

<div class="bg-white rounded shadow-sm overflow-x-auto">
<table class="w-full text-left">
    <thead class="border-b"><tr><th class="p-3">Order</th><th>Customer</th><th>Phone</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody>
    @forelse($orders as $o)
        <tr class="border-b">
            <td class="p-3"><a href="{{ route('admin.orders.show', $o) }}" class="underline">{{ $o->number }}</a></td>
            <td>{{ $o->name }}</td><td>{{ $o->phone }}</td>
            <td>৳ {{ number_format($o->total) }}</td><td>{{ ucfirst($o->status) }}</td>
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
