<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $order;

    public function __construct($order)
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
        
        $email = $this->from('weare@jobagency.id', 'VENTX')
                    ->subject('Your DBL Ticket Ticket')
                    ->view('mail.ticket')
                    ->with('order', $this->order);
        foreach ($this->order->tickets as $ticket){
            $email->attach(\Storage::disk('s3')->url($ticket->ticket_url), [
                'as' => $ticket->ticket_code.'.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        return $email;
    }
}
