<?php

namespace App\Http\Requests\Reseller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'         => ['filled' , 'max:255' , 'unique:resellers,name'],
            'email'        => ['filled' , 'max:255' , 'unique:resellers,email'],
            'phone_number' => ['filled' , 'max:255' , 'unique:resellers,phone_number'],
            'country'      => ['filled' , 'max:255'],
            'address'      => ['filled' , 'max:255'],
            'city'         => ['filled' , 'max:255'],
        ];
    }
}
