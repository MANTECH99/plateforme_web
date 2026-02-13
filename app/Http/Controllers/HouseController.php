<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HouseController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard.house', [
            'connectionsPending' => Connection::query()
                ->whereHas('house', fn ($q) => $q->where('user_id', Auth::id()))
                ->where('status', Connection::STATUS_PENDING)
                ->count(),
        ]);
    }

    public function profiles(Request $request): View
    {
        $job = $request->string('job')->toString();
        $city = $request->string('city')->toString();
        $certified = $request->string('certified')->toString(); // "1"|"0"|""
        $q = $request->string('q')->toString();

        $query = Personnel::query()->with('user');

        if ($job !== '') {
            $query->where('job_title', 'like', "%{$job}%");
        }
        if ($city !== '') {
            $query->where('city', 'like', "%{$city}%");
        }
        if ($certified === '1') {
            $query->where('certified', true);
        } elseif ($certified === '0') {
            $query->where('certified', false);
        }
        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('job_title', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$q}%"));
            });
        }

        $personnels = $query->latest()->paginate(10)->withQueryString();

        return view('profiles.index', compact('personnels', 'job', 'city', 'certified', 'q'));
    }

    public function showProfile(Personnel $personnel): View
    {
        $house = Auth::user()?->house;

        $connection = null;
        if ($house) {
            $connection = Connection::query()
                ->where('house_id', $house->id)
                ->where('personnel_id', $personnel->id)
                ->first();
        }

        return view('profiles.show', [
            'personnel' => $personnel->load('user'),
            'connection' => $connection,
        ]);
    }
}
