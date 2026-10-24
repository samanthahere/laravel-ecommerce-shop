<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** Confirmation email sent to the CUSTOMER. */
class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        $order->load('items');
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your order ' . $this->order->number . ' is received');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.order-customer');
    }
}
