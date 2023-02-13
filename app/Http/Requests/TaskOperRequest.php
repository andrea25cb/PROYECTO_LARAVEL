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

        'estadoTarea' => 'required',
        'anotA' => 'required',
        'anotP' => 'required',
        'fechaC' => 'required',
        'fechaR' =>'',
        'fichero' => '',
   
        
        ];
    }
}
