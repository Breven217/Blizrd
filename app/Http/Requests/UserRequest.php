<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class UserRequest extends FormRequest
{
    public ?User $user = null;

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

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
            'phone_number' => 'required|numeric|digits:10',
            'email_address' => 'required|email',
            'recieves_alerts' => 'required|boolean',
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
