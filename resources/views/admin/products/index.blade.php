@extends('layouts.admin')
@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-gray-900 text-white px-4 py-2 rounded">+ Add product</a>
</div>
<div class="bg-white rounded shadow-sm overflow-x-auto">
<table class="w-full text-left">
    <thead class="border-b"><tr><th class="p-3">Name</th><th>Category</th><th>Price</th><th>Stock</th><th></th></tr></thead>
    <tbody>
    @foreach($products as $p)
        <tr class="border-b">
            <td class="p-3">{{ $p->name }}</td><td>{{ $p->category?->name }}</td>
            <td>৳ {{ number_format($p->price) }}</td><td>{{ $p->stock }}</td>
            <td class="flex gap-3 p-3">
                <a href="{{ route('admin.products.edit', $p) }}" class="underline">Edit</a>
                <form method="POST" action="{{ route('admin.products.destroy', $p) }}" onsubmit="return confirm('Delete this product?')">
                    @csrf @method('DELETE')<button class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
