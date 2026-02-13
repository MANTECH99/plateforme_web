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
        <div class="rounded-[15px] bg-white p-5 shadow-sm">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Gestion de placement</h1>
                    <p class="mt-1 text-sm text-gray-600">Application mobile-first (personnel de maison & employeurs).</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-[#0d6efd]/10 px-3 py-1 text-xs font-semibold text-[#0d6efd]">
                    <i class="fa-solid fa-mobile-screen mr-1"></i> UX App
                </span>
            </div>

            <div class="mt-5 grid grid-cols-2 gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-[15px] bg-[#0d6efd] px-4 py-3 text-center text-sm font-semibold text-white hover:bg-[#0b5ed7]">
                        Accéder
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full rounded-[15px] bg-white px-4 py-3 text-sm font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                            Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-[15px] bg-white px-4 py-3 text-center text-sm font-semibold text-gray-800 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="rounded-[15px] bg-[#0d6efd] px-4 py-3 text-center text-sm font-semibold text-white hover:bg-[#0b5ed7]">
                        S’inscrire
                    </a>
                @endauth
            </div>
        </div>

        <div class="mt-4 rounded-[15px] bg-white p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-900">Workflow</h2>
            <ol class="mt-2 space-y-2 text-sm text-gray-700">
                <li><span class="font-semibold">1.</span> Personnel → s’inscrit (profil CV)</li>
                <li><span class="font-semibold">2.</span> Admin → valide (certifié)</li>
                <li><span class="font-semibold">3.</span> Maison → demande mise en relation</li>
                <li><span class="font-semibold">4.</span> Admin → accepte/refuse</li>
                <li><span class="font-semibold">5.</span> Chat → disponible si accepté</li>
            </ol>
        </div>
    </div>
</body>
</html>

