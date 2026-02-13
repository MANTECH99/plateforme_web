<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePersonnelProfileRequest;
use App\Models\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PersonnelController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();
        $personnel = $user?->personnel;

        $connections = Connection::query()
            ->with(['house.user'])
            ->when($personnel, fn ($q) => $q->where('personnel_id', $personnel->id))
            ->latest()
            ->paginate(10);

        return view('dashboard.personnel', [
            'personnel' => $personnel?->load('user'),
            'connections' => $connections,
        ]);
    }

    public function editProfile(): View
    {
        $user = Auth::user();
        $personnel = $user?->personnel;

        if (! $user || ! $personnel) {
            abort(403);
        }

        return view('personnel.profile.edit', [
            'user' => $user,
            'personnel' => $personnel,
        ]);
    }

    public function updateProfile(UpdatePersonnelProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $personnel = $user?->personnel;

        if (! $user || ! $personnel) {
            abort(403);
        }

        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
        ]);

        $update = [
            'job_title' => $data['job_title'],
            'experience_years' => $data['experience_years'],
            'description' => $data['description'] ?? null,
            'availability' => $data['availability'],
            'city' => $data['city'],
            'desired_salary' => $data['desired_salary'] ?? null,
            'skills' => $data['skills'] ?? null,
            'career_path' => $data['career_path'] ?? null,
            'work_history' => $data['work_history'] ?? null,
        ];

        if ($request->hasFile('photo')) {
            $newPath = $request->file('photo')->store('profile-photos', 'public');

            if ($personnel->photo_path) {
                Storage::disk('public')->delete($personnel->photo_path);
            }

            $update['photo_path'] = $newPath;
        }

        $personnel->update($update);

        return back()->with('status', 'Profil mis à jour.');
    }
}
