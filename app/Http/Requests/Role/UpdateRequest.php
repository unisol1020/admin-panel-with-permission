<?php

namespace App\Http\Requests\Role;

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
            'name'        => ['filled' , 'max:191' , 'unique:roles,name'],
            'permissions' => ['array' , 'min:1'],
            'entity'      => ['string' , 'filled']
        ];
    }

    protected function passedValidation(): void
    {
        $this->request->remove('root');
    }
}
