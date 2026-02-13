<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $baseRules = [
            'role' => ['required', Rule::in([User::ROLE_PERSONNEL, User::ROLE_HOUSE])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];

        $role = (string) $this->input('role');

        if ($role === User::ROLE_PERSONNEL) {
            return $baseRules + [
                'photo' => ['nullable', 'image', 'max:2048'],
                'job_title' => ['required', 'string', 'max:255'],
                'experience_years' => ['required', 'integer', 'min:0', 'max:80'],
                'description' => ['nullable', 'string', 'max:5000'],
                'availability' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'desired_salary' => ['nullable', 'integer', 'min:0'],
            ];
        }

        if ($role === User::ROLE_HOUSE) {
            return $baseRules + [
                'house_city' => ['nullable', 'string', 'max:255'],
            ];
        }

        return $baseRules;
    }

    public function attributes(): array
    {
        return [
            'role' => 'profil',
            'name' => 'nom',
            'email' => 'email',
            'phone' => 'téléphone',
            'photo' => 'photo de profil',
            'job_title' => 'métier',
            'experience_years' => 'expérience',
            'availability' => 'disponibilité',
            'city' => 'ville',
            'desired_salary' => 'salaire souhaité',
        ];
    }
}

