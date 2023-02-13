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
            'nif' => ['required','regex:/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/'],
            'email' => 'required|email',
            'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'cuentaCorriente' => 'min:12',
            'pais' => '',
            'moneda'=> '',
            'cuotaMensual'=> '',
        ];
       
    }
}
