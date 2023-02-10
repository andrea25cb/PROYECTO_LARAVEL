<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuoteRequest extends FormRequest
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
            'concepto' => 'required',
            'importe' => 'required',
            'pagada' => 'required',
            'created_at' => 'required',
            'fechaPago',
            'notas',
            'clients_id' => 'required',
        ];
    }
}
