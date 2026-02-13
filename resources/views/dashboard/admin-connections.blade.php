<x-app-layout>
    <div class="py-6">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-lg font-semibold text-gray-900">Demandes de mise en relation</h1>
                <p class="mt-1 text-sm text-gray-600">Validez les demandes avant accès au chat.</p>
            </div>
            <a class="text-sm font-semibold text-[#0d6efd]" href="{{ route('admin.dashboard') }}">Retour</a>
        </div>

        @if (session('status'))
            <div class="mt-3 rounded-[15px] bg-[#0d6efd]/10 p-3 text-sm text-[#0d6efd]">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-4 rounded-[15px] bg-white p-4 shadow-sm" method="GET">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-semibold text-gray-700">Statut</label>
                    <select name="status"
                        class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                    >
                        <option value="" @selected($status === '')>Tous</option>
                        <option value="pending" @selected($status === 'pending')>En attente</option>
                        <option value="approved" @selected($status === 'approved')>Accepté</option>
                        <option value="rejected" @selected($status === 'rejected')>Refusé</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full rounded-[15px] bg-[#0d6efd] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                        Filtrer
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-4 space-y-3">
            @foreach ($connections as $c)
                <div class="rounded-[15px] bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $c->house->user->name }}
                                <span class="text-gray-400">→</span>
                                {{ $c->personnel->user->name }}
                            </div>
                            <div class="mt-1 text-xs text-gray-500">
                                Maison: {{ $c->house->user->email }} • Personnel: {{ $c->personnel->user->email }}
                            </div>
                            <div class="mt-2">
                                @if ($c->status === 'approved')
                                    <span class="inline-flex items-center rounded-full bg-[#28a745]/10 px-2 py-0.5 text-xs font-semibold text-[#28a745]">Accepté</span>
                                @elseif ($c->status === 'rejected')
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-semibold text-red-700">Refusé</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">En attente</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex shrink-0 flex-col gap-2">
                            <form method="POST" action="{{ route('admin.connections.approve', $c) }}">
                                @csrf
                                @method('PUT')
                                <button class="rounded-[15px] bg-[#28a745] px-3 py-2 text-xs font-semibold text-white hover:bg-green-700">
                                    Accepter
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.connections.reject', $c) }}">
                                @csrf
                                @method('PUT')
                                <button class="rounded-[15px] bg-[#6c757d] px-3 py-2 text-xs font-semibold text-white hover:bg-gray-700">
                                    Refuser
                                </button>
                            </form>
                            @if ($c->status === 'approved')
                                <a href="{{ route('chat.show', $c) }}" class="rounded-[15px] border border-gray-200 px-3 py-2 text-center text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                    Ouvrir chat
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

