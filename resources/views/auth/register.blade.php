<x-guest-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-pearl border border-piano/10 rounded-3xl p-8 shadow-2xl animate-fade-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-piano"></div>
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-piano tracking-tight">Create an account</h2>
                <p class="text-sm text-piano/60 mt-2">Create your account to request and manage services.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Role selection -->
                <div x-data="{ role: 'customer' }" class="mb-6">
                    <label class="block text-sm font-bold text-piano mb-3 text-center">I am registering as a...</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="role" value="customer" x-model="role" class="sr-only">
                            <div class="p-4 border-2 rounded-xl text-center transition-all duration-300"
                                 :class="role === 'customer' ? 'border-piano bg-piano text-pearl shadow-lg scale-105' : 'border-piano/20 bg-pearl text-piano group-hover:border-piano/50'">
                                <div class="font-bold">Client</div>
                                <div class="text-xs mt-1" :class="role === 'customer' ? 'text-pearl/70' : 'text-piano/50'">Hire Experts</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="role" value="worker" x-model="role" class="sr-only">
                            <div class="p-4 border-2 rounded-xl text-center transition-all duration-300"
                                 :class="role === 'worker' ? 'border-piano bg-piano text-pearl shadow-lg scale-105' : 'border-piano/20 bg-pearl text-piano group-hover:border-piano/50'">
                                <div class="font-bold">Professional</div>
                                <div class="text-xs mt-1" :class="role === 'worker' ? 'text-pearl/70' : 'text-piano/50'">Offer Services</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-sm font-bold text-piano mb-2">Display Name</label>
                    <input id="name" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent text-piano transition-all" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-piano mb-2">Email</label>
                    <input id="email" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent text-piano transition-all" type="email" name="email" :value="old('email')" required />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-piano mb-2">Password</label>
                    <input id="password" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent text-piano transition-all" type="password" name="password" required />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-piano mb-2">Confirm password</label>
                    <input id="password_confirmation" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent text-piano transition-all" type="password" name="password_confirmation" required />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-piano py-3.5 text-lg shadow-xl shadow-piano/20">Create account</button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <span class="text-piano/60">Already have an account?</span>
                <a href="{{ route('login') }}" class="font-bold text-piano hover:underline ml-1">Sign in</a>
            </div>
        </div>
    </div>
</x-guest-layout>