<x-app-layout>
    <div class="py-6">
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-lg font-semibold text-gray-900">Dashboard Admin</h1>
                    <p class="mt-1 text-sm text-gray-600">Validation des profils et gestion des mises en relation.</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-[#0d6efd]/10 px-3 py-1 text-xs font-semibold text-[#0d6efd]">
                    Admin
                </span>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-3 gap-3">
            <div class="rounded-[15px] bg-white p-4 shadow-sm">
                <div class="text-xs text-gray-500">Profils</div>
                <div class="mt-1 text-2xl font-bold text-gray-900">{{ $personnelsTotal }}</div>
            </div>
            <div class="rounded-[15px] bg-white p-4 shadow-sm">
                <div class="text-xs text-gray-500">Certifiés</div>
                <div class="mt-1 text-2xl font-bold text-[#28a745]">{{ $personnelsCertified }}</div>
            </div>
            <div class="rounded-[15px] bg-white p-4 shadow-sm">
                <div class="text-xs text-gray-500">Demandes en attente</div>
                <div class="mt-1 text-2xl font-bold text-gray-900">{{ $connectionsPending }}</div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-2 gap-3">
            <a href="{{ route('admin.personnels') }}" class="rounded-[15px] bg-white p-4 shadow-sm hover:shadow transition">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-gray-900"><i class="fa-solid fa-id-card mr-2 text-[#0d6efd]"></i>Profils</div>
                        <div class="mt-1 text-xs text-gray-600">Filtrer, approuver ou refuser.</div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400"></i>
                </div>
            </a>
            <a href="{{ route('admin.connections') }}" class="rounded-[15px] bg-white p-4 shadow-sm hover:shadow transition">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-gray-900"><i class="fa-solid fa-link mr-2 text-[#0d6efd]"></i>Mises en relation</div>
                        <div class="mt-1 text-xs text-gray-600">Accepter/refuser les demandes.</div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400"></i>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>

