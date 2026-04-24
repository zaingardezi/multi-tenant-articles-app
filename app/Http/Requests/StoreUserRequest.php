<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class StoreUserRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'age' => 'required|numeric|min:1|max:119',
            'password' => 'required',
            
        ];
    }
}
