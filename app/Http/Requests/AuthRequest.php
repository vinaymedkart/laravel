<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules()
    {
        return match ($this->route()->getName()) {
            'register' => [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
                'phone_number' => 'nullable|string|min:10|max:15',
                'is_active' => 'boolean'
            ],
            'login' => [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string',
            ],
            default => []
        };
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'phone_number.min' => 'Phone number must be at least 10 characters',
            'phone_number.max' => 'Phone number must not exceed 15 characters'
        ];
    }
}