<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $query = Connection::query()
            ->with(['house.user', 'personnel.user'])
            ->where('status', Connection::STATUS_APPROVED);

        if ($user?->isHouse()) {
            $query->whereHas('house', fn ($q) => $q->where('user_id', $user->id));
        } elseif ($user?->isPersonnel()) {
            $query->whereHas('personnel', fn ($q) => $q->where('user_id', $user->id));
        } elseif ($user?->isAdmin()) {
            // admin voit tout
        } else {
            abort(403);
        }

        $connections = $query->latest()->paginate(10);

        return view('chat.index', compact('connections'));
    }

    public function show(Connection $connection): View
    {
        $this->authorizeConnection($connection);

        $messages = Message::query()
            ->where('connection_id', $connection->id)
            ->orderBy('created_at')
            ->take(200)
            ->get();

        return view('chat.show', [
            'connection' => $connection->load(['house.user', 'personnel.user']),
            'messages' => $messages,
            'me' => Auth::id(),
        ]);
    }

    public function store(Request $request, Connection $connection): RedirectResponse
    {
        $this->authorizeConnection($connection);

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'connection_id' => $connection->id,
            'sender_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return back();
    }

    private function authorizeConnection(Connection $connection): void
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $connection->loadMissing(['house', 'personnel']);

        $isParticipant = false;

        if ($user->isAdmin()) {
            $isParticipant = true;
        } elseif ($user->isHouse() && $connection->house && $connection->house->user_id === $user->id) {
            $isParticipant = true;
        } elseif ($user->isPersonnel() && $connection->personnel && $connection->personnel->user_id === $user->id) {
            $isParticipant = true;
        }

        if (! $isParticipant) {
            abort(403);
        }

        if (! $user->isAdmin() && ! $connection->isApproved()) {
            abort(403);
        }
    }
}
