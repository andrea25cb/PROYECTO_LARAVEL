<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        return [
            'name' => 'required', 
            'nif' => 'required|min:9|max:9',
            'email' => 'required|email',
            'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'cuentaCorriente' => 'min:12',
            'pais' => '',
            'moneda'=> '',
            'cuotaMensual'=> '',
        ];
       
    }
}
