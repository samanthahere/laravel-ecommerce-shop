@extends('layouts.admin')
@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $product->exists ? 'Edit' : 'Add' }} product</h1>
<form method="POST" enctype="multipart/form-data"
      action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
      class="bg-white p-6 rounded shadow-sm space-y-3 max-w-xl">
    @csrf
    @if($product->exists) @method('PUT') @endif
    <input name="name" value="{{ old('name', $product->name) }}" placeholder="Name" class="border rounded w-full px-3 py-2" required>
    <select name="category_id" class="border rounded w-full px-3 py-2">
        <option value="">No category</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id) == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    <input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" placeholder="Price (BDT)" class="border rounded w-full px-3 py-2" required>
    <input name="stock" type="number" value="{{ old('stock', $product->stock ?? 0) }}" placeholder="Stock" class="border rounded w-full px-3 py-2" required>
    <textarea name="description" rows="4" placeholder="Description" class="border rounded w-full px-3 py-2">{{ old('description', $product->description) }}</textarea>
    @if($product->image_url)<img src="{{ $product->image_url }}" class="h-24 rounded">@endif
    <input type="file" name="image" accept="image/*">
    <button class="bg-gray-900 text-white px-6 py-2 rounded">Save</button>
</form>
@endsection
