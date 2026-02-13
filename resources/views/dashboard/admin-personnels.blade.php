<x-app-layout>
    <div class="py-6">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h1 class="text-lg font-semibold text-gray-900">Candidatures (Personnel)</h1>
                <p class="mt-1 text-sm text-gray-600">Tous les profils, certifiés ou non.</p>
            </div>
            <a class="text-sm font-semibold text-[#0d6efd]" href="{{ route('admin.dashboard') }}">Retour</a>
        </div>

        @if (session('status'))
            <div class="mt-3 rounded-[15px] bg-[#0d6efd]/10 p-3 text-sm text-[#0d6efd]">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-4 rounded-[15px] bg-white p-4 shadow-sm" method="GET">
            <div class="grid grid-cols-1 gap-3">
                <div>
                    <label class="text-xs font-semibold text-gray-700">Recherche</label>
                    <input name="q" value="{{ $q }}" placeholder="Nom, métier, ville..."
                        class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                    />
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Certification</label>
                        <select name="certified"
                            class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                        >
                            <option value="" @selected($certified === '')>Tous</option>
                            <option value="1" @selected($certified === '1')>Certifiés</option>
                            <option value="0" @selected($certified === '0')>Non certifiés</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button class="w-full rounded-[15px] bg-[#0d6efd] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-4 space-y-3">
            @foreach ($personnels as $p)
                <div class="rounded-[15px] bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <div class="truncate text-sm font-semibold text-gray-900">{{ $p->user->name }}</div>
                                @if ($p->certified)
                                    <span class="inline-flex items-center rounded-full bg-[#28a745]/10 px-2 py-0.5 text-xs font-semibold text-[#28a745]">
                                        <i class="fa-solid fa-badge-check mr-1"></i> Certifié
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-[#6c757d]/10 px-2 py-0.5 text-xs font-semibold text-[#6c757d]">
                                        Non certifié
                                    </span>
                                @endif
                            </div>
                            <div class="mt-1 text-sm text-gray-700">
                                <span class="font-semibold">{{ $p->job_title }}</span>
                                <span class="text-gray-400">•</span>
                                <span>{{ $p->city }}</span>
                                <span class="text-gray-400">•</span>
                                <span>{{ $p->experience_years }} ans</span>
                            </div>
                            <div class="mt-1 text-xs text-gray-500">Email: {{ $p->user->email }} • Tél: {{ $p->user->phone }}</div>
                        </div>

                        <div class="flex shrink-0 flex-col gap-2">
                            <form method="POST" action="{{ route('admin.personnels.approve', $p) }}">
                                @csrf
                                @method('PUT')
                                <button class="rounded-[15px] bg-[#28a745] px-3 py-2 text-xs font-semibold text-white hover:bg-green-700">
                                    Approuver
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.personnels.reject', $p) }}">
                                @csrf
                                @method('PUT')
                                <button class="rounded-[15px] bg-[#6c757d] px-3 py-2 text-xs font-semibold text-white hover:bg-gray-700">
                                    Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $personnels->links() }}
        </div>
    </div>
</x-app-layout>

