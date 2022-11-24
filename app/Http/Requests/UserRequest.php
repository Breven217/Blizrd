<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public ?User $user = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|string',
            'phone_number' => 'required|numeric|digits:11',
            'email_address' => 'required|email',
            'receives_alerts' => 'required|boolean',
            'user_id' => 'nullable|integer|exists:user,id'
        ];
    }

    public function passedValidation()
    {
        if (filled($this->input('user_id'))){
            $this->user = User::find($this->input('user_id'));
        }
    }
}
