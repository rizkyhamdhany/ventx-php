<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProceesBookTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'payment_method' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'contact_birthday[month]' => 'required',
            'contact_birthday[day]' => 'required',
            'contact_birthday[year]' => 'required',
            'contact_address' => 'required',
            'contact_county' => 'required',
            'contact_city' => 'required',
            'contact_postal_code' => 'required',
        ];
        return $rules;
    }
}
