<?php

use Illuminate\Database\Seeder;
use App\Models\TicketClass;

class TicketClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket = new TicketClass();
        $ticket->name = 'Reguler';
        $ticket->status = 'active';
        $ticket->row = 0;
        $ticket->col = 0;
        $ticket->have_seat = false;
        $ticket->save();
    }
}
