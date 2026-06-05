@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
         class="fixed bottom-6 right-6 z-50 animate-toast-slide flex items-center gap-3 bg-piano text-pearl px-6 py-4 rounded-xl shadow-2xl transition-opacity duration-500"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4">
        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-medium tracking-wide">{{ session('success') }}</span>
    </div>
@endif

@if (session('error') || session('failure') || $errors->any())
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" 
         class="fixed bottom-6 right-6 z-50 animate-toast-slide flex items-center gap-3 bg-failure text-pearl px-6 py-4 rounded-xl shadow-2xl transition-opacity duration-500"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4">
        <svg class="w-6 h-6 text-pearl" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        <span class="font-medium tracking-wide">
            {{ session('error') ?? session('failure') ?? $errors->first() }}
        </span>
    </div>
@endif