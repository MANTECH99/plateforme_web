<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\House;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $role = (string) ($validated['role'] ?? $request->input('role'));

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
