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
            'name' => 'required|max:100',
            'short_name' => 'required|max:100',
            'organizer' => 'required|max:100',
            'logo_color' => 'image|mimes:jpeg,bmp,png|size:2000',
            'logo_white' => 'image|mimes:jpeg,bmp,png|size:2000',
            'background_pattern' => 'image|mimes:jpeg,bmp,png|size:2000',
            'pattern_footer' => 'image|mimes:jpeg,bmp,png|size:2000',
            'date' => 'required',
            'color_primary' => 'required',
            'color_secondary' => 'required',
            'time' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lon' => 'required',
        ];
        return $rules;
    }
}
