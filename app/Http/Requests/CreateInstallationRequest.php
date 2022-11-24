<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateInstallationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'installed_on' => 'required|date',
            'location_id' => 'required|integer|exists:location,id',
            'actions' => 'nullable|array:vehicle_id,user_id,installed',
                'actions.*.vehicle_id' => 'required|integer|exists:vehicle,id',
                'actions.*.user_id' => 'required|integer|exists:user,id',
                'actions.*.installed' => 'required|boolean'
        ];
    }
}
