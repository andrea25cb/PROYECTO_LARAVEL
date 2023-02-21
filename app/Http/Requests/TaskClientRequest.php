<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:9',
        'email' => 'required|email',
        'descripcion' => 'required',
        'direccion' => 'required',
        'poblacion' => 'required',
        'cp' => 'min:5',
        'provincia' => 'required',
        'estadoTarea' => 'required',
        'anotA' => 'required',
        'anotP' => 'required',
        'fechaC' => 'required',
        'fechaR' =>'nullable|after_or_equal:fechaC',
        'clients_id' => 'required', //el que inicia sesion
        // 'users_id' => 'required',
        
        ];
    }
}
