<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $baseRules = [
            'role' => ['required', Rule::in([User::ROLE_PERSONNEL, User::ROLE_HOUSE])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $role = (string) $request->input('role');
        $extraRules = [];

        if ($role === User::ROLE_PERSONNEL) {
            $extraRules = [
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
            $extraRules = [
                'house_city' => ['nullable', 'string', 'max:255'],
            ];
        }

        $validated = $request->validate($baseRules + $extraRules);

        $user = DB::transaction(function () use ($request, $validated, $role) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'role' => $role,
                'password' => Hash::make($validated['password']),
            ]);

            if ($role === User::ROLE_PERSONNEL) {
                $photoPath = null;
                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('profile-photos', 'public');
                }

                Personnel::create([
                    'user_id' => $user->id,
                    'photo_path' => $photoPath,
                    'job_title' => $validated['job_title'],
                    'experience_years' => $validated['experience_years'],
                    'description' => $validated['description'] ?? null,
                    'availability' => $validated['availability'],
                    'city' => $validated['city'],
                    'desired_salary' => $validated['desired_salary'] ?? null,
                ]);
            }

            if ($role === User::ROLE_HOUSE) {
                House::create([
                    'user_id' => $user->id,
                    'city' => $validated['house_city'] ?? null,
                ]);
            }

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
