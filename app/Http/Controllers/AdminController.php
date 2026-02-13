<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Personnel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard.admin', [
            'personnelsTotal' => Personnel::count(),
            'personnelsCertified' => Personnel::where('certified', true)->count(),
            'connectionsPending' => Connection::where('status', Connection::STATUS_PENDING)->count(),
        ]);
    }

    public function personnels(Request $request): View
    {
        $certified = $request->string('certified')->toString(); // "1"|"0"|""|"all"
        $q = $request->string('q')->toString();

        $query = Personnel::query()->with('user');

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

        return view('dashboard.admin-personnels', compact('personnels', 'certified', 'q'));
    }

    public function approvePersonnel(Personnel $personnel): RedirectResponse
    {
        $personnel->update(['certified' => true]);

        return back()->with('status', 'Profil approuvé.');
    }

    public function rejectPersonnel(Personnel $personnel): RedirectResponse
    {
        $personnel->update(['certified' => false]);

        return back()->with('status', 'Profil refusé.');
    }

    public function connections(Request $request): View
    {
        $status = $request->string('status')->toString();

        $query = Connection::query()->with(['house.user', 'personnel.user']);

        if ($status !== '') {
            $query->where('status', $status);
        }

        $connections = $query->latest()->paginate(10)->withQueryString();

        return view('dashboard.admin-connections', compact('connections', 'status'));
    }

    public function approveConnection(Connection $connection): RedirectResponse
    {
        $connection->update(['status' => Connection::STATUS_APPROVED]);

        return back()->with('status', 'Mise en relation acceptée.');
    }

    public function rejectConnection(Connection $connection): RedirectResponse
    {
        $connection->update(['status' => Connection::STATUS_REJECTED]);

        return back()->with('status', 'Mise en relation refusée.');
    }
}
