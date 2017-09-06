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
            'name' => 'required|max:50',
            'email' => 'required',
            'phone' => 'required',
        ];
        return $rules;
    }
}
