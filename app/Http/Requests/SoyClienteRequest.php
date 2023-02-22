<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class SoyClienteRequest extends FormRequest
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
            'nif' => ['required','regex:/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/'],
            'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'name' => 'required', 
       
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
        'clients_id' => '', //el que inicia sesion
        'users_id' => '',
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        return $this->only(['nif', 'tlf']);
    }

}