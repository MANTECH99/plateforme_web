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
                    <input id="filter-q" name="q" value="{{ $q }}" placeholder="Nom, métier, ville..."
                        class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                    />
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Métier</label>
                        <input id="filter-job" name="job" value="{{ $job }}" placeholder="Ex: nounou"
                            class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                        />
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Ville</label>
                        <input id="filter-city" name="city" value="{{ $city }}" placeholder="Ex: Dakar"
                            class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Certifié</label>
                        <select id="filter-certified" name="certified"
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

        <div id="profiles-results" class="mt-4">
            @include('profiles.partials.results', ['personnels' => $personnels])
        </div>
    </div>

    <script>
        (() => {
            const form = document.querySelector('form');
            const target = document.getElementById('profiles-results');
            const q = document.getElementById('filter-q');
            const job = document.getElementById('filter-job');
            const city = document.getElementById('filter-city');
            const certified = document.getElementById('filter-certified');

            let timer = null;
            async function refresh() {
                const url = new URL(window.location.href);
                const params = new URLSearchParams(new FormData(form));
                url.search = params.toString();

                const res = await fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (!res.ok) return;
                const html = await res.text();
                target.innerHTML = html;
                window.history.replaceState({}, '', url.toString());
            }

            function schedule() {
                if (timer) clearTimeout(timer);
                timer = setTimeout(refresh, 250);
            }

            [q, job, city].forEach((el) => el && el.addEventListener('input', schedule));
            certified && certified.addEventListener('change', schedule);
        })();
    </script>
</x-app-layout>

