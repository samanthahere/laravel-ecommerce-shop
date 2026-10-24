<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** Email sent to the SHOP OWNER when a new order comes in. */
class OrderPlacedAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        $order->load('items');
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New order ' . $this->order->number . ' - ' . number_format($this->order->total) . ' BDT');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.order-admin');
    }
}
