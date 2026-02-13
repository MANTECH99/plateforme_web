<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonnelProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],

            'photo' => ['nullable', 'image', 'max:2048'],
            'job_title' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:80'],
            'description' => ['nullable', 'string', 'max:5000'],
            'availability' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'desired_salary' => ['nullable', 'integer', 'min:0'],

            'skills' => ['nullable', 'string', 'max:5000'],
            'career_path' => ['nullable', 'string', 'max:5000'],
            'work_history' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'phone' => 'téléphone',
            'photo' => 'photo de profil',
            'job_title' => 'métier',
            'experience_years' => 'expérience',
            'description' => 'description',
            'availability' => 'disponibilité',
            'city' => 'ville',
            'desired_salary' => 'salaire souhaité',
            'skills' => 'compétences',
            'career_path' => 'parcours professionnel',
            'work_history' => 'maisons où il/elle a travaillé',
        ];
    }
}

