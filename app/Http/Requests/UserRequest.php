<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guest();
    }

    public function rules(): array
    {
        return [
            'username' => 'required|unique:users|string|min:4',
            'phone' => 'required|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:12'
        ];
    }
}
