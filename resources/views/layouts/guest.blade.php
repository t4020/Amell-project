<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Amel') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-piano bg-pearl flex flex-col min-h-screen">

    <nav x-data="{ open: false }" class="fixed w-full z-40 glass-effect border-b border-piano/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Amel') }}" class="h-10 w-auto object-contain">
                    </a>
                    <div class="hidden md:flex ml-12 space-x-8">
                        <a href="{{ route('explore') }}" class="text-sm font-semibold text-piano/70 hover:text-piano transition-colors py-2">Explore</a>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-piano">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-piano hover:opacity-70 transition-opacity">Log in</a>
                        <a href="{{ route('register') }}" class="btn-piano">Sign up</a>
                    @endauth
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-piano hover:bg-piano/5 transition-colors">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition class="md:hidden glass-effect border-b border-piano/10">
            <div class="pt-2 pb-3 space-y-1 px-4 sm:px-6">
                <a href="{{ route('explore') }}" class="block px-3 py-2 text-base font-medium text-piano">Explore</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-piano">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-piano">Log in</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-piano">Sign up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20">
        {{ $slot }}
    </main>

    <footer class="bg-pearl border-t border-piano/10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row items-center justify-between gap-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Amel') }}" class="h-10 w-auto object-contain">
            </a>

            <div class="text-sm text-piano/60 text-center md:text-right max-w-2xl">
                <div class="font-semibold text-piano">A dependable way to hire vetted professionals.</div>
                <div class="mt-2 flex flex-wrap items-center justify-center md:justify-end gap-x-6 gap-y-2">
                    <a href="{{ route('explore') }}" class="hover:text-piano">Explore services</a>
                    <a href="{{ route('register') }}" class="hover:text-piano">Create an account</a>
                    <a href="{{ route('login') }}" class="hover:text-piano">Sign in</a>
                </div>
                <div class="mt-3 text-piano/40">&copy; {{ date('Y') }} {{ config('app.name', 'Amel') }}. All rights reserved.</div>
            </div>
        </div>
    </footer>

    <x-toast />
</body>
</html>