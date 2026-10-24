<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('shop.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] } } } }
    </script>
    <style>html{scroll-behavior:smooth}</style>
</head>
<body class="bg-[#f5f3ef] text-neutral-900 font-sans antialiased min-h-screen flex flex-col">

<div class="bg-neutral-900 text-neutral-200 text-xs text-center py-2 tracking-wide">
    Cash on Delivery &nbsp;·&nbsp; Delivery all over Bangladesh
</div>

<header class="sticky top-0 z-20 bg-[#f5f3ef]/80 backdrop-blur-md">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between">
        <a href="{{ route('shop.index') }}" class="text-lg font-extrabold tracking-tight lowercase">{{ config('shop.name') }}<span class="text-neutral-400">.</span></a>
        <nav class="flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('shop.index') }}#products" class="hover:opacity-60 transition">Shop</a>
            <a href="{{ route('cart.index') }}" class="flex items-center gap-2 bg-neutral-900 text-white rounded-full pl-4 pr-1.5 py-1.5 hover:bg-neutral-700 transition">
                Cart
                <span class="bg-white text-neutral-900 text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">{{ \App\Support\Cart::count() }}</span>
            </a>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto px-5 py-8 w-full flex-1">
    @include('layouts.messages')
    @yield('content')
</main>

<footer class="mt-16 border-t border-neutral-300">
    <div class="max-w-6xl mx-auto px-5 py-12">
        <div class="text-5xl md:text-7xl font-extrabold tracking-tighter lowercase text-neutral-300 mb-8">{{ config('shop.name') }}</div>
        <div class="flex flex-col md:flex-row gap-3 md:gap-10 text-sm text-neutral-500">
            <span>{{ config('shop.admin_email') }}</span>
            <span>Phone: 01XXXXXXXXX</span>
            <span class="md:ml-auto">&copy; {{ date('Y') }} {{ config('shop.name') }}</span>
        </div>
    </div>
</footer>
</body>
</html>
