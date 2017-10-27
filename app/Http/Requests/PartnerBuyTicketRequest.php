<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerBuyTicketRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(){
        $rules = [
            'contact_fullname' => 'required|max:50',
            'contact_email' => 'required',
            'contact_phone' => 'required',
        ];
        return $rules;
    }
}
