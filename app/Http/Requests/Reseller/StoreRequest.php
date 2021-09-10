<?php

namespace App\Http\Requests\Reseller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'name'         => ['required' , 'max:255' , 'unique:resellers,name'],
            'email'        => ['required' , 'max:255' , 'unique:resellers,email'],
            'phone_number' => ['required' , 'max:255' , 'unique:resellers,phone_number'],
            'country'      => ['required' , 'max:255'],
            'address'      => ['required' , 'max:255'],
            'city'         => ['required' , 'max:255'],
        ];
    }
}
