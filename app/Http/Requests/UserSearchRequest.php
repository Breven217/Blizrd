<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserSearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|prohibits:phone_number|prohibits:email_address',
            'phone_number' => 'nullable|numeric|digits:10|prohibits:name|prohibits:email_address',
            'email_address' => 'nullable|email|prohibits:phone_number|prohibits:name'
        ];
    }
}
