<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,'.$this->input('id'),
            'role' => 'required|string',
            'password_super_admin' => 'required',
        ];

        if($this->isMethod('POST')){
            $rules['password'] = 'required|min:4|string|confirmed' ;
        }

        return  $rules;
    }
}
