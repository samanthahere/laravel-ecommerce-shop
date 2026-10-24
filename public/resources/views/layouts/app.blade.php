<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('shop.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
<header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="{{ route('shop.index') }}" class="text-xl font-bold">{{ config('shop.name') }}</a>
        <a href="{{ route('cart.index') }}" class="font-medium">Cart ({{ \App\Support\Cart::count() }})</a>
    </div>
</header>
<main class="max-w-6xl mx-auto px-4 py-6">
    @include('layouts.messages')
    @yield('content')
</main>
</body>
</html>
