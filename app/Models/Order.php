<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Order extends Model
{

    public function createOrder($input){
        $uuid = Uuid::generate();
        $code = strtoupper(array_slice(explode('-',$uuid), -1)[0]);
        $this->order_code = 'SMO'.$code;
        $this->name = $input->input('contact_fullname');
        $this->phonenumber = $input->input('contact_phone');
        $this->email = $input->input('contact_email');
        $this->ticket_period = $input->input('ticket_period');
        $this->ticket_class = $input->input('ticket_class');
        $this->ticket_ammount = $input->input('ammount');
        $this->payment_status = 'COMPLETE';
        $this->payment_code = 'test';
        $this->save();
    }
    public function tickets()
    {
        return $this
            ->belongsToMany('App\Models\Ticket')
            ->withTimestamps();
    }
}
