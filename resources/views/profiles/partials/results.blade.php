<div class="space-y-3">
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

