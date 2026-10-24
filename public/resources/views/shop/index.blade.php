@extends('layouts.app')
@section('content')
<form method="GET" class="flex gap-2 mb-4">
    <input name="q" value="{{ request('q') }}" placeholder="Search products..." class="border rounded px-3 py-2 flex-1">
    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
    <button class="bg-gray-900 text-white px-4 rounded">Search</button>
</form>

<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('shop.index') }}" class="px-3 py-1 rounded border {{ request('category') ? 'bg-white' : 'bg-gray-900 text-white' }}">All</a>
    @foreach($categories as $c)
        <a href="{{ route('shop.index', ['category' => $c->slug]) }}"
           class="px-3 py-1 rounded border {{ request('category') === $c->slug ? 'bg-gray-900 text-white' : 'bg-white' }}">{{ $c->name }}</a>
    @endforeach
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse($products as $p)
        <a href="{{ route('shop.show', $p) }}" class="bg-white rounded shadow-sm hover:shadow p-3 block">
            @if($p->image_url)
                <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-full h-40 object-cover rounded mb-2">
            @else
                <div class="w-full h-40 bg-gray-200 rounded mb-2 flex items-center justify-center text-gray-400">No image</div>
            @endif
            <div class="font-medium">{{ $p->name }}</div>
            <div class="text-gray-600">৳ {{ number_format($p->price) }}</div>
            @if($p->stock < 1)<div class="text-red-600 text-sm">Out of stock</div>@endif
        </a>
    @empty
        <p>No products found.</p>
    @endforelse
</div>
<div class="mt-6">{{ $products->links() }}</div>
@endsection
