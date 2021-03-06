<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
          //|dimensions:ratio=4/3,max-width=100,max-height=100
            'name' => 'required|max:100',
            'short_name' => 'required|max:100',
            'organizer' => 'required|max:100',
            'date' => 'required',
            'color_primary' => 'required',
            'color_secondary' => 'required',
            'color_accent' => 'required',
            'time' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lon' => 'required',
        ];
        return $rules;
    }
}
