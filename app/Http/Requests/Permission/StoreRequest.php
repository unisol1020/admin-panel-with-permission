<?php

namespace App\Http\Requests\Permission;

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
            'name'        => ['required' , 'string' , 'max:191' , 'filled' , 'unique:permissions,name'],
            'entity'      => ['required' , 'string' , 'max:191' , 'filled'],
            'permissions' => ['required' , 'array' , 'min:1'],
        ];
    }
}
