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
            'contact_birthday_month' => 'numeric|min:1|max:12',
            'contact_birthday_day' => 'numeric|min:1',
            'contact_birthday_year' => 'numeric|min:1',
            'contact_address' => 'required',
            'contact_country' => 'required',
            'contact_city' => 'required',
            'contact_postal_code' => 'required',
        ];
        return $rules;
    }
}
