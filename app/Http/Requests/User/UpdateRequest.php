<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'first_name' => ['filled', 'string', 'max:191'],
            'last_name'  => ['filled', 'string', 'max:191'],
            'email'      => ['filled', 'string', 'email', 'max:191', 'unique:users,email'],
            'gender'     => [Rule::in(['man' , 'woman' ,'unknown'])],
            'city'       => ['filled' , 'string'],
            'country'    => ['filled' , 'string'],
            'phone'      => ['filled' , 'integer'],
            'birthdate'  => ['filled' , 'date'],
            'roles'      => ['array' , 'min:1']
        ];
    }

    protected function passedValidation(): void
    {
        $this->request->remove('password');
    }
}
