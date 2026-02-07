<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'unique:users,login'],
            'email' => ['required', 'string', 'unique:users,email', 'email:rfc,dns'],
            'password' => ['required', 'string', 'min:6'],
            'weight' => ['required', 'numeric', 'min:30', 'max:250'],
            'height' => ['required', 'numeric', 'min:70', 'max:350'],
            'gender_id' => ['required', 'integer', 'exists:genders,id'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'activity_level_id' => ['required', 'integer', 'exists:activity_levels,id'],
            'goal_type_id' => ['required', 'integer', 'exists:goal_types,id'],
        ];
    }
}
