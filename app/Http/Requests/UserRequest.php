<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserRequest extends FormRequest
{
    public ?User $user = null;

    /**
     * Custom Failed Response
     *
     * Overrides the Illuminate\Foundation\Http\FormRequest
     * response function to stop it from auto redirecting
     * and applies a API custom response format.
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors) {

        // Put whatever response you want here.
        return new JsonResponse([
            'status' => '422',
            'errors' => $errors,
        ], 422);
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
