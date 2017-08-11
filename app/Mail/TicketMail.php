<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
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
        $email = $this->from('ticket@nalar-ventex.com')
                    ->subject('Your Smilemotion Ticket')
                    ->view('mail.ticket')
                    ->with('order', $this->order);
        foreach ($this->order->tickets as $ticket){
            $email->attach(\Storage::disk('s3')->url($ticket->url_ticket), [
                'as' => 'name.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        return $email;
    }
}
