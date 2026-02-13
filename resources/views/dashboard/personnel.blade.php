<x-app-layout>
    <div class="py-6">
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">Dashboard Personnel</h1>
                    <p class="mt-1 text-sm text-gray-600">Votre profil (type CV) et vos mises en relation.</p>
                </div>
                @if($personnel?->certified)
                    <span class="inline-flex items-center rounded-full bg-[#28a745]/10 px-3 py-1 text-xs font-semibold text-[#28a745]">
                        <i class="fa-solid fa-badge-check mr-1"></i> Certifié
                    </span>
                @else
                    <span class="inline-flex items-center rounded-full bg-[#6c757d]/10 px-3 py-1 text-xs font-semibold text-[#6c757d]">
                        Non certifié
                    </span>
                @endif
            </div>

            @if($personnel)
                <div class="mt-4 rounded-[15px] bg-[#f8f9fa] p-4">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 overflow-hidden rounded-full bg-gray-200">
                            @if($personnel->photo_path)
                                <img class="h-full w-full object-cover" src="{{ asset('storage/'.$personnel->photo_path) }}" alt="Photo" />
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-gray-900">{{ $personnel->user->name }}</div>
                            <div class="text-xs text-gray-600">{{ $personnel->job_title }} • {{ $personnel->city }} • {{ $personnel->experience_years }} ans</div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-4 rounded-[15px] bg-amber-50 p-4 text-sm text-amber-800">
                    Votre profil personnel n’est pas encore créé.
                </div>
            @endif
        </div>

        <div class="mt-4 rounded-[15px] bg-white p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-900">Mes mises en relation</h2>
            <div class="mt-3 space-y-3">
                @forelse($connections as $c)
                    <div class="rounded-[15px] bg-[#f8f9fa] p-4">
                        <div class="text-sm font-semibold text-gray-900">{{ $c->house->user->name }}</div>
                        <div class="mt-1 text-xs text-gray-600">
                            Statut:
                            <span class="font-semibold">{{ $c->status }}</span>
                        </div>
                        @if($c->status === 'approved')
                            <a href="{{ route('chat.show', $c) }}" class="mt-3 inline-flex items-center rounded-[15px] bg-[#0d6efd] px-4 py-2 text-xs font-semibold text-white hover:bg-[#0b5ed7]">
                                Ouvrir le chat
                            </a>
                        @endif
                    </div>
                @empty
                    <div class="text-sm text-gray-600">Aucune demande pour le moment.</div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $connections->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

