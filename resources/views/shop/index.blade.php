@extends('layouts.app')
@section('content')

@unless(request()->hasAny(['q', 'category', 'page']))
@php $featured = $products->first(); @endphp
<section class="grid md:grid-cols-2 gap-8 items-center mb-16 md:mb-24 pt-4">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-neutral-500 mb-5">New season</p>
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter leading-[0.95] mb-6">Simple.<br>Timeless.<br>Yours.</h1>
        <p class="text-neutral-600 max-w-md mb-8">Carefully picked pieces at honest prices. Order online, pay when it arrives at your door.</p>
        <div class="flex gap-3">
            <a href="#products" class="bg-neutral-900 text-white px-7 py-3.5 rounded-full font-semibold hover:bg-neutral-700 transition">Shop collection</a>
            @if($featured)
                <a href="{{ route('shop.show', $featured) }}" class="px-7 py-3.5 rounded-full font-semibold border border-neutral-900 hover:bg-neutral-900 hover:text-white transition">Latest drop</a>
            @endif
        </div>
    </div>
    <div class="relative">
        <div class="aspect-[4/5] rounded-[2rem] overflow-hidden bg-gradient-to-br from-stone-200 via-stone-300 to-neutral-400">
            @if($featured && $featured->image_url)
                <img src="{{ $featured->image_url }}" alt="{{ $featured->name }}" class="w-full h-full object-cover">
            @endif
        </div>
        @if($featured)
        <div class="absolute -bottom-4 left-4 right-4 md:left-auto md:-left-6 md:right-auto bg-white rounded-2xl px-5 py-3 shadow-lg md:w-56">
            <div class="text-xs text-neutral-500">Latest</div>
            <div class="font-semibold text-sm truncate">{{ $featured->name }}</div>
            <div class="text-sm">৳ {{ number_format($featured->price) }}</div>
        </div>
        @endif
    </div>
</section>
@endunless

<div id="products" class="scroll-mt-24">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
        <h2 class="text-3xl font-extrabold tracking-tight">{{ request('category') ? ucfirst(request('category')) : 'All products' }}</h2>
        <form method="GET" class="flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Search" class="bg-white rounded-full px-5 py-2.5 text-sm w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-neutral-900">
            @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
            <button class="bg-neutral-900 text-white rounded-full px-5 text-sm font-semibold">Go</button>
        </form>
    </div>

    <div class="flex flex-wrap gap-2 mb-8 text-sm font-medium">
        <a href="{{ route('shop.index') }}#products" class="px-5 py-2 rounded-full transition {{ request('category') ? 'bg-white hover:bg-neutral-200' : 'bg-neutral-900 text-white' }}">All</a>
        @foreach($categories as $c)
            <a href="{{ route('shop.index', ['category' => $c->slug]) }}#products"
               class="px-5 py-2 rounded-full transition {{ request('category') === $c->slug ? 'bg-neutral-900 text-white' : 'bg-white hover:bg-neutral-200' }}">{{ $c->name }}</a>
        @endforeach
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-10 md:gap-x-6">
        @forelse($products as $p)
            <a href="{{ route('shop.show', $p) }}" class="group block">
                <div class="relative aspect-[4/5] rounded-3xl overflow-hidden bg-stone-200 mb-3">
                    @if($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-stone-200 to-stone-300"></div>
                    @endif
                    @if($p->stock < 1)
                        <span class="absolute top-3 left-3 bg-white text-neutral-900 text-[11px] font-semibold px-3 py-1 rounded-full">Sold out</span>
                    @endif
                    <span class="absolute bottom-3 right-3 bg-white rounded-full w-10 h-10 flex items-center justify-center text-lg opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition">→</span>
                </div>
                <div class="flex justify-between gap-3 px-1">
                    <div class="text-sm font-medium leading-snug">{{ $p->name }}</div>
                    <div class="text-sm text-neutral-600 whitespace-nowrap">৳ {{ number_format($p->price) }}</div>
                </div>
            </a>
        @empty
            <p class="col-span-full text-center text-neutral-500 py-16">No products found.</p>
        @endforelse
    </div>
    <div class="mt-12">{{ $products->links() }}</div>
</div>
@endsection
