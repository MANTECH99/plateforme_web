<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use Illuminate\Support\Facades\Auth;
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
}
