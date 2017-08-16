<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookTicketRequest extends FormRequest
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
            'contact_name' => 'required|max:255',
            'contact_phone' => 'required|max:255',
            'contact_email' => 'required|max:255',
        ];

        $i = 0;
        foreach($this->request->get('ticket') as $key)
        {
            $rules['ticket.'.$i.'.ticket_title'] = 'required|max:255';
            $rules['ticket.'.$i.'.ticket_name'] = 'required|max:255';
            $rules['ticket.'.$i.'.ticket_email'] = 'required|max:255';
            $rules['ticket.'.$i.'.ticket_phone'] = 'required|max:255';
            $i++;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'contact_name.required' => 'Please insert your name correctly',
            'contact_phone.required'  => 'Please insert your phone number correctly',
            'contact_email.required'  => 'Please insert your email address correctly',
        ];
    }

}
