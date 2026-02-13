<x-app-layout>
    <div class="py-6">
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <h1 class="text-lg font-semibold text-gray-900">Messagerie</h1>
            <p class="mt-1 text-sm text-gray-600">Disponible uniquement après validation admin.</p>
        </div>

        <div class="mt-4 space-y-3">
            @forelse($connections as $c)
                @php
                    $me = auth()->user();
                    $title = $me?->isHouse() ? $c->personnel->user->name : $c->house->user->name;
                    $subtitle = $me?->isHouse()
                        ? ($c->personnel->job_title.' • '.$c->personnel->city)
                        : ($c->house->user->email);
                @endphp
                <a href="{{ route('chat.show', $c) }}" class="block rounded-[15px] bg-white p-4 shadow-sm hover:shadow transition">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-gray-900">{{ $title }}</div>
                            <div class="mt-1 truncate text-xs text-gray-600">{{ $subtitle }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-300"></i>
                    </div>
                </a>
            @empty
                <div class="rounded-[15px] bg-white p-5 text-sm text-gray-600 shadow-sm">
                    Aucun chat disponible pour le moment.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $connections->links() }}
        </div>
    </div>
</x-app-layout>

