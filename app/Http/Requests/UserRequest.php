<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        'descripcion' => 'required',
        'direccion' => 'required',
        'estadoTarea' => 'required',
        'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:9',
        'email' => 'required|email',
        'poblacion' => 'required',
        'provincia' => 'required',
        'users_id' => 'required',
        'clients_id' => 'required',
        'cp' => 'min:5',
        'fechaC' => 'required',
        'fechaR' =>'after_or_equal:fechaC',
        'fichero' => 'required',
        'anotA' => 'required',
        'anotP' => 'required',
        ];
    }
}
