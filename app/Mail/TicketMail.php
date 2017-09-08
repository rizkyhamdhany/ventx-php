<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\Models\Event;

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
        $event = Event::find($this->order->event_id);
        $email = $this->from('Ticket@nalar-ventex.com', 'Nalar Ventex')
                    ->subject('Your '.$event->name.' Ticket')
                    ->view('mail.ticket')
                    ->with('order', $this->order);
        foreach ($this->order->tickets as $ticket){
            $email->attach(\Storage::disk('s3')->url($ticket->url_ticket), [
                'as' => $ticket->name.'.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        if ($this->order->event_id == 0){
            $email->attach(\Storage::disk('s3')->url($this->order->url_invoice), [
                'as' => $this->order->name.'.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        return $email;
    }
}
