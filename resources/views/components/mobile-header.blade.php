@props([
    'title' => null,
    'backUrl' => null,
])

@php
    $user = auth()->user();
    $resolvedTitle = $title;
    if (! $resolvedTitle) {
        $resolvedTitle = config('app.name', 'Gestion placement');
    }
@endphp

<header class="md:hidden fixed top-0 left-0 w-full z-50">
    <div class="bg-white/80 backdrop-blur border-b border-gray-200 shadow-sm">
        <div class="mx-auto max-w-md px-4 pt-[max(0.75rem,env(safe-area-inset-top))] pb-3">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2 min-w-0">
                    @if($backUrl)
                        <a href="{{ $backUrl }}"
                           class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-sm ring-1 ring-gray-200 text-gray-700">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    @else
                        <div class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-[#0d6efd]/10 text-[#0d6efd]">
                            <i class="fa-solid fa-house"></i>
                        </div>
                    @endif

                    <div class="min-w-0">
                        <div class="truncate text-sm font-semibold text-gray-900">{{ $resolvedTitle }}</div>
                        @if($user)
                            <div class="truncate text-[11px] text-gray-600">
                                {{ $user->name }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    @if($user)
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-2 text-xs font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200">
                                <i class="fa-solid fa-right-from-bracket text-gray-500"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center rounded-full bg-white px-3 py-2 text-xs font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200">
                            Connexion
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

