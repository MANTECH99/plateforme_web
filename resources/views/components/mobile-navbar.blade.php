@php
    use App\Models\Connection;

    $user = auth()->user();
    $pendingConnections = 0;

    if ($user?->isAdmin()) {
        $pendingConnections = Connection::where('status', Connection::STATUS_PENDING)->count();
    } elseif ($user?->isHouse() && $user->house) {
        $pendingConnections = Connection::where('house_id', $user->house->id)
            ->where('status', Connection::STATUS_PENDING)
            ->count();
    } elseif ($user?->isPersonnel() && $user->personnel) {
        $pendingConnections = Connection::where('personnel_id', $user->personnel->id)
            ->where('status', Connection::STATUS_PENDING)
            ->count();
    }

    $current = request()->route()?->getName();
@endphp

<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 bg-white border-t border-gray-200 shadow-[0_-2px_12px_rgba(0,0,0,0.08)]">
    <div class="mx-auto max-w-md px-2 pb-[max(0.5rem,env(safe-area-inset-bottom))] pt-2">
        <div class="grid grid-cols-5 gap-1 text-center text-[11px]">
            <a href="{{ route('dashboard') }}"
               class="flex flex-col items-center justify-center gap-1 rounded-xl py-2 {{ str_starts_with((string) $current, 'admin.') || str_starts_with((string) $current, 'personnel.') || str_starts_with((string) $current, 'house.') ? 'text-[#0d6efd]' : 'text-gray-600' }}">
                <i class="fa-solid fa-house text-base"></i>
                <span>Accueil</span>
            </a>

            <a href="{{ $user?->isHouse() ? route('house.profiles') : ($user?->isAdmin() ? route('admin.personnels') : route('dashboard')) }}"
               class="flex flex-col items-center justify-center gap-1 rounded-xl py-2 text-gray-600">
                <i class="fa-solid fa-magnifying-glass text-base"></i>
                <span>Profils</span>
            </a>

            <a href="{{ $user?->isAdmin() ? route('admin.connections') : ($user?->isHouse() ? route('house.connections') : route('dashboard')) }}"
               class="relative flex flex-col items-center justify-center gap-1 rounded-xl py-2 text-gray-600">
                <i class="fa-solid fa-link text-base"></i>
                <span>Demandes</span>
                @if($pendingConnections > 0)
                    <span class="absolute top-1 right-4 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-[#0d6efd] px-1 text-[10px] font-semibold text-white">
                        {{ $pendingConnections }}
                    </span>
                @endif
            </a>

            <a href="{{ route('chat.index') }}"
               class="flex flex-col items-center justify-center gap-1 rounded-xl py-2 text-gray-600">
                <i class="fa-solid fa-comments text-base"></i>
                <span>Chat</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex flex-col items-center justify-center gap-1 rounded-xl py-2 text-gray-600">
                <i class="fa-solid fa-user text-base"></i>
                <span>Compte</span>
            </a>
        </div>
    </div>
</nav>

