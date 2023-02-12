<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskOperRequest extends FormRequest
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
        'fechaR' =>'',
        'fichero' => '',
        'clients_id' => 'required',
        'users_id' => 'required',
        
        ];
    }
}
