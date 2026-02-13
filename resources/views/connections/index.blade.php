<x-app-layout>
    <div class="py-6">
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <h1 class="text-lg font-semibold text-gray-900">Mes demandes</h1>
            <p class="mt-1 text-sm text-gray-600">Suivez l’état de vos mises en relation.</p>
        </div>

        @if (session('status'))
            <div class="mt-3 rounded-[15px] bg-[#0d6efd]/10 p-3 text-sm text-[#0d6efd]">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-4 space-y-3">
            @foreach($connections as $c)
                <div class="rounded-[15px] bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="text-sm font-semibold text-gray-900">{{ $c->personnel->user->name }}</div>
                            <div class="mt-1 text-xs text-gray-600">{{ $c->personnel->job_title }} • {{ $c->personnel->city }}</div>
                            <div class="mt-2">
                                @if ($c->status === 'approved')
                                    <span class="inline-flex items-center rounded-full bg-[#28a745]/10 px-2 py-0.5 text-xs font-semibold text-[#28a745]">Acceptée</span>
                                @elseif ($c->status === 'rejected')
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-semibold text-red-700">Refusée</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">En attente</span>
                                @endif
                            </div>
                        </div>

                        <div class="shrink-0">
                            @if($c->status === 'approved')
                                <a href="{{ route('chat.show', $c) }}" class="rounded-[15px] bg-[#0d6efd] px-3 py-2 text-xs font-semibold text-white hover:bg-[#0b5ed7]">
                                    Chat
                                </a>
                            @else
                                <a href="{{ route('house.profiles.show', $c->personnel) }}" class="rounded-[15px] border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                    Voir profil
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $connections->links() }}
        </div>
    </div>
</x-app-layout>

