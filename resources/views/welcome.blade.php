<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gestion Placement') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8f9fa] font-sans antialiased">
    <div class="mx-auto min-h-screen max-w-md px-4 py-8">
        <div class="relative overflow-hidden rounded-[15px] bg-white p-6 shadow-sm">
            <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#0d6efd]/10"></div>
            <div class="absolute -left-20 -bottom-20 h-52 w-52 rounded-full bg-[#28a745]/10"></div>

            <div class="relative">
                <div class="inline-flex items-center gap-2 rounded-full bg-[#0d6efd]/10 px-3 py-1 text-xs font-semibold text-[#0d6efd]">
                    <i class="fa-solid fa-shield-heart"></i>
                    Plateforme sécurisée
                </div>

                <h1 class="mt-4 text-2xl font-extrabold tracking-tight text-gray-900">
                    Trouvez le bon personnel de maison, en toute confiance.
                </h1>
                <p class="mt-2 text-sm leading-relaxed text-gray-600">
                    Une plateforme professionnelle qui met en relation des <span class="font-semibold text-gray-800">maisons (employeurs)</span>
                    et du <span class="font-semibold text-gray-800">personnel</span>, avec validation admin et messagerie intégrée.
                </p>

                <div class="mt-5 grid grid-cols-2 gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="rounded-[15px] bg-[#0d6efd] px-4 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                            Accéder
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full rounded-[15px] bg-white px-4 py-3 text-sm font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                                Se déconnecter
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-[15px] bg-white px-4 py-3 text-center text-sm font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                           class="rounded-[15px] bg-[#0d6efd] px-4 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                            Inscription
                        </a>
                    @endauth
                </div>

                <div class="mt-5 grid grid-cols-3 gap-2 text-center">
                    <div class="rounded-[15px] bg-[#f8f9fa] p-3">
                        <div class="text-[#0d6efd]"><i class="fa-solid fa-user-check"></i></div>
                        <div class="mt-1 text-[11px] font-semibold text-gray-800">Profils</div>
                        <div class="text-[10px] text-gray-600">CV moderne</div>
                    </div>
                    <div class="rounded-[15px] bg-[#f8f9fa] p-3">
                        <div class="text-[#28a745]"><i class="fa-solid fa-badge-check"></i></div>
                        <div class="mt-1 text-[11px] font-semibold text-gray-800">Certification</div>
                        <div class="text-[10px] text-gray-600">Validation admin</div>
                    </div>
                    <div class="rounded-[15px] bg-[#f8f9fa] p-3">
                        <div class="text-[#0d6efd]"><i class="fa-solid fa-comments"></i></div>
                        <div class="mt-1 text-[11px] font-semibold text-gray-800">Chat</div>
                        <div class="text-[10px] text-gray-600">Après accord</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 rounded-[15px] bg-white p-6 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-900">Notre mission</h2>
            <p class="mt-2 text-sm leading-relaxed text-gray-700">
                Professionnaliser le placement de personnel de maison grâce à des profils structurés, une validation transparente
                et un parcours simple pour les employeurs.
            </p>
        </div>

        <div class="mt-4 rounded-[15px] bg-white p-6 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-900">Comment ça marche</h2>
            <ol class="mt-3 space-y-3">
                <li class="flex gap-3">
                    <div class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-[#0d6efd]/10 text-xs font-bold text-[#0d6efd]">1</div>
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">Personnel</span> crée son profil (CV).
                    </div>
                </li>
                <li class="flex gap-3">
                    <div class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-[#0d6efd]/10 text-xs font-bold text-[#0d6efd]">2</div>
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">Admin</span> approuve et attribue le badge <span class="font-semibold text-[#28a745]">Certifié</span>.
                    </div>
                </li>
                <li class="flex gap-3">
                    <div class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-[#0d6efd]/10 text-xs font-bold text-[#0d6efd]">3</div>
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">Maison</span> demande une mise en relation.
                    </div>
                </li>
                <li class="flex gap-3">
                    <div class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-[#0d6efd]/10 text-xs font-bold text-[#0d6efd]">4</div>
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">Admin</span> accepte/refuse, puis le <span class="font-semibold">chat</span> s’active si accepté.
                    </div>
                </li>
            </ol>
        </div>

        <div class="mt-4 pb-4 text-center text-xs text-gray-500">
            © {{ date('Y') }} {{ config('app.name', 'Gestion Placement') }} • Mobile-first
        </div>
    </div>
</body>
</html>

