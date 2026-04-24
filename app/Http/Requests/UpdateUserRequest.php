<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        $user=$this->route('user');
        return [
             'name' => 'required|alpha',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|numeric',
            'age' => 'required|numeric|min:1|max:119',
            
        ];






    }
}
