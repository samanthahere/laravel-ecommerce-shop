<div style="font-family:Arial,sans-serif;max-width:600px">
    <h2>Thanks, {{ $order->name }}! We received your order.</h2>
    <p>Order number: <strong>{{ $order->number }}</strong></p>
    <table width="100%" cellpadding="6" style="border-collapse:collapse;border:1px solid #ddd">
        <tr style="background:#f3f3f3"><th align="left">Item</th><th>Qty</th><th align="right">Price</th></tr>
        @foreach($order->items as $item)
        <tr><td>{{ $item->name }}</td><td align="center">{{ $item->quantity }}</td><td align="right">{{ number_format($item->price * $item->quantity) }}</td></tr>
        @endforeach
        <tr><td colspan="2"><strong>Total</strong></td><td align="right"><strong>{{ number_format($order->total) }} BDT</strong></td></tr>
    </table>
    <p>Delivery address: {{ $order->address }}, {{ $order->district }}<br>Payment: Cash on Delivery</p>
    <p>We will contact you on {{ $order->phone }} soon. Thank you for shopping with {{ config('shop.name') }}.</p>
</div>
