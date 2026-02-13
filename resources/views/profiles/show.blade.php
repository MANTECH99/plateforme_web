<x-app-layout>
    <div class="py-6">
        <a href="{{ route('house.profiles') }}" class="inline-flex items-center text-sm font-semibold text-[#0d6efd]">
            <i class="fa-solid fa-chevron-left mr-2"></i> Retour aux profils
        </a>

        <div class="mt-3 rounded-[15px] bg-white p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="h-20 w-20 shrink-0 overflow-hidden rounded-[15px] bg-gray-200">
                    @if($personnel->photo_path)
                        <img class="h-full w-full object-cover" src="{{ asset('storage/'.$personnel->photo_path) }}" alt="Photo" />
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <h1 class="truncate text-lg font-semibold text-gray-900">{{ $personnel->user->name }}</h1>
                        @if($personnel->certified)
                            <span class="inline-flex animate-pulse items-center rounded-full bg-[#28a745]/10 px-2 py-0.5 text-xs font-semibold text-[#28a745]">
                                <i class="fa-solid fa-badge-check mr-1"></i> Certifié
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-[#6c757d]/10 px-2 py-0.5 text-xs font-semibold text-[#6c757d]">
                                Non certifié
                            </span>
                        @endif
                    </div>
                    <div class="mt-1 text-sm text-gray-700">
                        <span class="font-semibold">{{ $personnel->job_title }}</span>
                        <span class="text-gray-400">•</span> {{ $personnel->experience_years }} ans
                        <span class="text-gray-400">•</span> {{ $personnel->city }}
                    </div>
                    <div class="mt-1 text-xs text-gray-500">
                        Disponibilité: <span class="font-semibold">{{ $personnel->availability }}</span>
                    </div>

                    <div class="mt-4">
                        @if($connection && $connection->status === 'approved')
                            <a href="{{ route('chat.show', $connection) }}"
                               class="inline-flex items-center rounded-[15px] bg-[#0d6efd] px-4 py-2 text-sm font-semibold text-white hover:bg-[#0b5ed7]">
                                <i class="fa-solid fa-comments mr-2"></i> Ouvrir le chat
                            </a>
                        @elseif($connection && $connection->status === 'pending')
                            <div class="inline-flex items-center rounded-[15px] bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-800">
                                <i class="fa-solid fa-hourglass-half mr-2"></i> Demande en attente (validation admin)
                            </div>
                        @elseif($connection && $connection->status === 'rejected')
                            <div class="inline-flex items-center rounded-[15px] bg-red-100 px-4 py-2 text-sm font-semibold text-red-800">
                                <i class="fa-solid fa-circle-xmark mr-2"></i> Demande refusée
                            </div>
                        @else
                            <form method="POST" action="{{ route('house.profiles.connect', $personnel) }}">
                                @csrf
                                <button class="w-full rounded-[15px] bg-[#0d6efd] px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                                    <i class="fa-solid fa-link mr-2"></i> Demander mise en relation
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 gap-3">
            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Description</h2>
                <p class="mt-2 text-sm text-gray-700">
                    {{ $personnel->description ?: '—' }}
                </p>
            </div>

            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Compétences</h2>
                <p class="mt-2 text-sm text-gray-700">
                    {{ $personnel->skills ?: '—' }}
                </p>
            </div>

            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Parcours professionnel</h2>
                <p class="mt-2 text-sm text-gray-700">
                    {{ $personnel->career_path ?: '—' }}
                </p>
            </div>

            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Maisons où il/elle a travaillé</h2>
                <p class="mt-2 text-sm text-gray-700">
                    {{ $personnel->work_history ?: '—' }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

