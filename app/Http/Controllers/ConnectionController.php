<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Personnel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConnectionController extends Controller
{
    public function request(Request $request, Personnel $personnel): RedirectResponse
    {
        $house = Auth::user()?->house;

        if (! $house) {
            abort(403);
        }

        Connection::firstOrCreate(
            [
                'house_id' => $house->id,
                'personnel_id' => $personnel->id,
            ],
            [
                'status' => Connection::STATUS_PENDING,
            ]
        );

        return back()->with('status', 'Demande de mise en relation envoyée.');
    }

    public function indexHouse(): View
    {
        $house = Auth::user()?->house;

        if (! $house) {
            abort(403);
        }

        $connections = Connection::query()
            ->with(['personnel.user'])
            ->where('house_id', $house->id)
            ->latest()
            ->paginate(10);

        return view('connections.index', compact('connections'));
    }
}
