<?php

namespace App\Http\Requests\Hostname;

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
            'fqdn'       => ['string' , 'unique:hostnames,fqdn' , 'filled'],
            'website_id' => ['integer' , 'filled']
        ];
    }
}
