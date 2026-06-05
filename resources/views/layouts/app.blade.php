<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Amel Dashboard') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-piano bg-[#F8F9FA] flex flex-col min-h-screen">

    <nav x-data="{ open: false }" class="bg-pearl border-b border-piano/10 shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Amel') }}" class="h-10 w-auto object-contain">
                    </a>
                    <div class="hidden sm:-my-px sm:ml-10 sm:flex sm:space-x-8">
                        <a href="{{ route('explore') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('explore') || request()->routeIs('category.*') || request()->routeIs('worker.*') ? 'border-piano text-piano' : 'border-transparent text-piano/60 hover:text-piano hover:border-piano/30' }} text-sm font-medium transition-colors">
                            Explore
                        </a>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-piano text-piano' : 'border-transparent text-piano/60 hover:text-piano hover:border-piano/30' }} text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('requests.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('requests.*') ? 'border-piano text-piano' : 'border-transparent text-piano/60 hover:text-piano hover:border-piano/30' }} text-sm font-medium transition-colors">
                            Requests
                        </a>
                        @if(auth()->user()->isWorker())
                            <a href="{{ route('services.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('services.*') ? 'border-piano text-piano' : 'border-transparent text-piano/60 hover:text-piano hover:border-piano/30' }} text-sm font-medium transition-colors">
                                Services
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 text-sm font-medium text-piano hover:opacity-70 transition-opacity focus:outline-none">
                                <div class="w-10 h-10 rounded-full bg-piano text-pearl flex items-center justify-center font-bold shadow-md">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div>{{ auth()->user()->name }}</div>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile Settings</x-dropdown-link>
                            <x-dropdown-link :href="route('worker.profile', auth()->user())">Public Profile</x-dropdown-link>
                            <x-dropdown-link :href="route('explore')">Explore</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-failure">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-piano hover:bg-piano/5 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" class="sm:hidden border-t border-piano/10">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('explore') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('explore') || request()->routeIs('category.*') || request()->routeIs('worker.*') ? 'border-piano text-piano bg-piano/5' : 'border-transparent text-piano/60' }} text-base font-medium">Explore</a>
                <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-piano text-piano bg-piano/5' : 'border-transparent text-piano/60' }} text-base font-medium">Dashboard</a>
                <a href="{{ route('requests.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('requests.*') ? 'border-piano text-piano bg-piano/5' : 'border-transparent text-piano/60' }} text-base font-medium">Requests</a>
                @if(auth()->user()->isWorker())
                    <a href="{{ route('services.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('services.*') ? 'border-piano text-piano bg-piano/5' : 'border-transparent text-piano/60' }} text-base font-medium">Services</a>
                @endif
            </div>
            <div class="pt-4 pb-1 border-t border-piano/10">
                <div class="px-4">
                    <div class="font-medium text-base text-piano">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-piano/60">{{ auth()->user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-piano/60 hover:text-piano hover:bg-piano/5">Profile</a>
                    <a href="{{ route('worker.profile', auth()->user()) }}" class="block px-4 py-2 text-base font-medium text-piano/60 hover:text-piano hover:bg-piano/5">Public Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-base font-medium text-failure hover:bg-failure/10">Log Out</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full animate-fade-in">
        {{ $slot }}
    </main>

    <footer class="bg-pearl border-t border-piano/10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Amel') }}" class="h-9 w-auto object-contain">
            </a>
            <div class="text-sm text-piano/60 text-center md:text-right">
                <div class="font-semibold text-piano">Reliable services. Clear communication. Strong outcomes.</div>
                <div class="mt-1">&copy; {{ date('Y') }} {{ config('app.name', 'Amel') }}. All rights reserved.</div>
            </div>
        </div>
    </footer>

    <x-toast />
</body>
</html>