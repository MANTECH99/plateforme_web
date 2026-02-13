<x-app-layout>
    <div class="py-6">
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <h1 class="text-lg font-semibold text-gray-900">Profils disponibles</h1>
            <p class="mt-1 text-sm text-gray-600">Filtrez par métier, ville et certification.</p>
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
                        <label class="text-xs font-semibold text-gray-700">Métier</label>
                        <input name="job" value="{{ $job }}" placeholder="Ex: nounou"
                            class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                        />
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Ville</label>
                        <input name="city" value="{{ $city }}" placeholder="Ex: Dakar"
                            class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Certifié</label>
                        <select name="certified"
                            class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                        >
                            <option value="" @selected($certified === '')>Tous</option>
                            <option value="1" @selected($certified === '1')>Oui</option>
                            <option value="0" @selected($certified === '0')>Non</option>
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
            @foreach($personnels as $p)
                <a href="{{ route('house.profiles.show', $p) }}" class="block rounded-[15px] bg-white p-4 shadow-sm hover:shadow transition">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 overflow-hidden rounded-full bg-gray-200 shrink-0">
                            @if($p->photo_path)
                                <img class="h-full w-full object-cover" src="{{ asset('storage/'.$p->photo_path) }}" alt="Photo" />
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <div class="truncate text-sm font-semibold text-gray-900">{{ $p->user->name }}</div>
                                @if($p->certified)
                                    <span class="inline-flex items-center rounded-full bg-[#28a745]/10 px-2 py-0.5 text-xs font-semibold text-[#28a745]">
                                        <i class="fa-solid fa-badge-check mr-1"></i> Certifié
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-[#6c757d]/10 px-2 py-0.5 text-xs font-semibold text-[#6c757d]">
                                        Non certifié
                                    </span>
                                @endif
                            </div>
                            <div class="mt-1 text-xs text-gray-600">
                                {{ $p->job_title }} • {{ $p->city }} • {{ $p->experience_years }} ans
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-300"></i>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $personnels->links() }}
        </div>
    </div>
</x-app-layout>

