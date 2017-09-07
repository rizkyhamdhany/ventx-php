<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;

    public function __construct(Book $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Ticket@nalar-ventex.com', 'Nalar Ventex')
                    ->subject('Complete Your '.$this->order->event_name.' Ticket Purchase')
                    ->text('mail.order_plain_text')
                    ->view('mail.order')
                    ->with('order', $this->order);
//        ->attach('/path/to/file');
//        ->attach('/path/to/file', [
//            'as' => 'name.pdf',
//            'mime' => 'application/pdf',
//        ]);
    }
}
