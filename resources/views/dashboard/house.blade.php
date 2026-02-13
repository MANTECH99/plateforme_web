<x-app-layout>
    <div class="py-6">
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <h1 class="text-lg font-semibold text-gray-900">Dashboard Maison</h1>
            <p class="mt-1 text-sm text-gray-600">Trouvez un profil et demandez une mise en relation.</p>

            <div class="mt-4 flex items-center gap-3">
                <a href="{{ route('house.profiles') }}"
                   class="flex-1 rounded-[15px] bg-[#0d6efd] px-4 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>Voir les profils
                </a>
                <a href="{{ route('house.connections') }}"
                   class="flex-1 rounded-[15px] bg-white px-4 py-3 text-center text-sm font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                    <i class="fa-solid fa-link mr-2 text-[#0d6efd]"></i>Mes demandes
                    @if(($connectionsPending ?? 0) > 0)
                        <span class="ml-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-[#0d6efd] px-1 text-[11px] font-semibold text-white">
                            {{ $connectionsPending }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

