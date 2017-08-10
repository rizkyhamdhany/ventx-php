<?php

namespace App\Mail;

use App\Models\Preorder;
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

    public function __construct(Preorder $order)
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
        return $this->from('ticket@nalar-ventex.com')
                    ->subject('Complete Your Smilemotion Ticket Purchase')
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
