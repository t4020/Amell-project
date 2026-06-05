Categories<x-guest-layout>
    <div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-pearl border border-piano/10 rounded-3xl p-8 shadow-2xl animate-fade-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-piano"></div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-piano tracking-tight">Sign in</h2>
                <p class="text-sm text-piano/60 mt-2">Access your account to manage requests and services.</p>
            </div>

            <x-auth-session-status class="mb-4 text-center font-bold text-success" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-piano mb-2">Email</label>
                    <input id="email" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent text-piano transition-all" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-bold text-piano">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-piano/50 hover:text-piano transition-colors" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <input id="password" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent text-piano transition-all" type="password" name="password" required />
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-piano/20 text-piano shadow-sm focus:ring-piano" name="remember">
                    <span class="ml-2 text-sm text-piano/60 font-medium">Remember me</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-piano py-3.5 text-lg shadow-xl shadow-piano/20">Sign in</button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm border-t border-piano/10 pt-6">
                <span class="text-piano/60">New to the ecosystem?</span>
                <a href="{{ route('register') }}" class="font-bold text-piano hover:underline ml-1">Create an account</a>
            </div>
        </div>
    </div>
</x-guest-layout>