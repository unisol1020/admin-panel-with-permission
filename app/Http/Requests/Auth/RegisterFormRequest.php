<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:191' , 'filled'],
            'last_name'  => ['required', 'string', 'max:191' , 'filled'],
            'email'      => ['required', 'string', 'email', 'max:191', 'unique:users,email' , 'filled'],
            'password'   => ['required', 'string', 'min:6' , 'filled'],
            'gender'     => [Rule::in(['man' , 'woman' ,'unknown'])],
            'city'       => ['filled' , 'string'],
            'country'    => ['filled' , 'string'],
            'phone'      => ['filled' , 'integer'],
            'birthdate'  => ['filled' , 'date']
        ];
    }

    protected function passedValidation(): void
    {
        $this->request->set('password', Hash::make($this->request->get('password')));
    }
}
