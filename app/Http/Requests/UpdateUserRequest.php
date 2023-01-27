<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'nif' => 'required|min:9',
            'name' => 'required',
            'tlf' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',   
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'direccion' => 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
