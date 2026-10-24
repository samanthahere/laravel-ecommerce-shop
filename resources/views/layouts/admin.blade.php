<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('shop.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<nav class="bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-6">
        <span class="font-bold">Admin</span>
        <a href="{{ route('admin.orders.index') }}">Orders</a>
        <a href="{{ route('admin.products.index') }}">Products</a>
        <a href="{{ route('shop.index') }}" target="_blank" class="ml-auto">View shop</a>
        <form method="POST" action="{{ route('admin.logout') }}">@csrf<button>Logout</button></form>
    </div>
</nav>
<main class="max-w-6xl mx-auto px-4 py-6">
    @include('layouts.messages')
    @yield('content')
</main>
</body>
</html>
