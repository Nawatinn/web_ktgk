<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    public $cart;
    public $tong;

    public function __construct($cart, $tong)
    {
        $this->cart = $cart;
        $this->tong = $tong;
    }

    public function build()
    {
        return $this->subject('Xác nhận đặt hàng thành công')
                    ->view('emails.order-success');
    }
}