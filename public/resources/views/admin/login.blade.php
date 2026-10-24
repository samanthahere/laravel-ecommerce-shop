<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin login</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<form method="POST" action="{{ route('admin.login.post') }}" class="bg-white p-8 rounded shadow w-full max-w-sm space-y-3">
    @csrf
    <h1 class="text-xl font-bold">Admin login</h1>
    @include('layouts.messages')
    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="border rounded w-full px-3 py-2" required>
    <input type="password" name="password" placeholder="Password" class="border rounded w-full px-3 py-2" required>
    <button class="bg-gray-900 text-white w-full py-2 rounded">Login</button>
</form>
</body></html>
