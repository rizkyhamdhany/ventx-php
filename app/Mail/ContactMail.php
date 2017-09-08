<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('Ticket@nalar-ventex.com', 'Nalar Ventex')
            ->subject('[Ventex Contact Us] Message from '.$this->data['name'])
            ->text('mail.order_plain_text')
            ->view('mail.contact')
            ->with('data', $this->data);
    }
}
