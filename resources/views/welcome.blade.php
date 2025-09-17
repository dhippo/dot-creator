<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dot-Creator</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-black text-white">

<!-- Background polygon: passe derrière et ignore les clics -->
<div class="blur-3xl fixed inset-0 -z-10 pointer-events-none overflow-hidden" aria-hidden="true">
    <div class="absolute left-[calc(50%-11rem)] top-0 aspect-[1155/678]
                    w-[36.125rem] rotate-[30deg] blur-3xl
                    bg-blue-300 from-blue-300 to-blue-300 opacity-30
                    sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
         style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
    </div>
</div>

<!-- Header (au-dessus du fond) -->
<header class="w-full relative z-10">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <!-- Logo (haut gauche) -->
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
            <img src="{{ asset('logos/logo-dot-white.png') }}" alt="Dot-Creator" class="h-8 w-auto" />
        </a>

        <!-- Right side: Auth links + Lang select -->
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:opacity-80">
                    {{ __('auth.dashboard') }}
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium hover:opacity-80">
                    {{ __('auth.login') }}
                </a>
                <a href="{{ route('register') }}"
                   class="text-sm font-medium bg-white text-black px-3 py-1.5 rounded hover:opacity-90">
                    {{ __('auth.register') }}
                </a>
            @endauth

            <!-- Language Selector Dropdown -->
            <form action="{{ route('lang.switch') }}" method="POST">
                @csrf
                <select name="locale" id="locale" onchange="this.form.submit()"
                        class="border border-gray-700 bg-black text-white pl-4 py-1 text-sm rounded
                                   {{ app()->getLocale() == 'fr' ? 'pr-8' : 'pr-6' }}">
                    <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                </select>
            </form>
        </div>
    </div>
</header>

<!-- Hero -->
<main class="relative z-10">
    @livewire('welcome-page')
</main>

@livewireScripts
</body>
</html>
