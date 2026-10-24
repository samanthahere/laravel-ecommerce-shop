<div style="font-family:Arial,sans-serif;max-width:600px">
    <h2>New order {{ $order->number }}</h2>
    <p><strong>Customer:</strong> {{ $order->name }}<br>
    <strong>Phone:</strong> {{ $order->phone }}<br>
    <strong>Email:</strong> {{ $order->email }}<br>
    <strong>Address:</strong> {{ $order->address }}, {{ $order->district }}<br>
    @if($order->note)<strong>Note:</strong> {{ $order->note }}<br>@endif
    <strong>Payment:</strong> Cash on Delivery</p>
    <table width="100%" cellpadding="6" style="border-collapse:collapse;border:1px solid #ddd">
        <tr style="background:#f3f3f3"><th align="left">Item</th><th>Qty</th><th align="right">Price</th></tr>
        @foreach($order->items as $item)
        <tr><td>{{ $item->name }}</td><td align="center">{{ $item->quantity }}</td><td align="right">{{ number_format($item->price * $item->quantity) }}</td></tr>
        @endforeach
        <tr><td colspan="2"><strong>Total</strong></td><td align="right"><strong>{{ number_format($order->total) }} BDT</strong></td></tr>
    </table>
    <p><a href="{{ route('admin.orders.show', $order) }}">Open in admin panel</a></p>
</div>
