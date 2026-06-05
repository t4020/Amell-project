<x-guest-layout>
    <div class="bg-piano py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in text-center md:text-left md:flex items-center gap-10">
            <div class="w-32 h-32 md:w-40 md:h-40 bg-pearl text-piano rounded-full flex items-center justify-center text-6xl font-black shadow-2xl mx-auto md:mx-0 shrink-0">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="mt-6 md:mt-0">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-pearl mb-3">{{ $user->name }}</h1>
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 text-pearl/80 mb-4 font-medium text-lg">
                    <span class="flex items-center gap-1 text-success">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        {{ number_format($averageRating, 1) }} Rating
                    </span>
                    @if($user->workerProfile?->location)
                        <span class="opacity-50">|</span>
                        <span>{{ $user->workerProfile->location }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 animate-fade-in -mt-10 relative z-10">
        
        <div class="bg-pearl border border-piano/10 rounded-3xl p-8 md:p-12 shadow-xl mb-12">
            <h2 class="text-2xl font-bold text-piano mb-6">About</h2>
            <p class="text-piano/80 text-lg leading-relaxed whitespace-pre-line">{{ $user->workerProfile?->bio ?? 'This professional has not added a bio yet.' }}</p>
            
            @auth
                @if($user->workerProfile?->phone)
                <div class="mt-8 inline-flex items-center gap-3 px-5 py-3 bg-[#F8F9FA] rounded-xl border border-piano/5">
                    <svg class="w-5 h-5 text-piano/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span class="font-medium text-piano">{{ $user->workerProfile->phone }}</span>
                </div>
                @endif
            @endauth
        </div>

        <h2 class="text-3xl font-bold text-piano mb-8">Services</h2>
        @if($user->services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
                @foreach($user->services as $service)
                    <div class="bg-pearl border border-piano/10 rounded-2xl overflow-hidden shadow-sm flex flex-col group">
                        <div class="p-6 flex-grow">
                            <div class="text-xs font-bold text-piano/50 uppercase tracking-wider mb-2">{{ $service->category->name }}</div>
                            <h3 class="font-bold text-xl text-piano mb-3 group-hover:text-piano/70 transition-colors">{{ $service->title }}</h3>
                            <div class="font-black text-2xl text-piano mb-4">${{ number_format($service->price, 2) }}</div>
                            <p class="text-piano/60 text-sm line-clamp-2">{{ $service->description }}</p>
                        </div>
                        <a href="{{ route('requests.create', ['service_id' => $service->id]) }}" class="block w-full text-center bg-piano text-pearl py-4 font-bold hover:bg-piano/90 transition-colors">
                            Request Service
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-piano/60 text-lg mb-16">No active services listed currently.</p>
        @endif

        <h2 class="text-3xl font-bold text-piano mb-8 border-t border-piano/10 pt-12">Client Reviews</h2>
        @if($user->reviewsReceived->count() > 0)
            <div class="space-y-6">
                @foreach($user->reviewsReceived as $review)
                    <div class="bg-[#F8F9FA] p-6 rounded-2xl border border-piano/5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-piano/10 text-piano font-bold flex items-center justify-center">
                                    {{ substr($review->customer->name, 0, 1) }}
                                </div>
                                <div class="font-semibold text-piano">{{ $review->customer->name }}</div>
                            </div>
                            <div class="flex gap-1 text-success">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-piano/80 leading-relaxed italic">"{{ $review->comment ?? 'No comment provided.' }}"</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-piano/60 text-lg border-b border-piano/10 pb-12">No reviews yet.</p>
        @endif
    </div>
</x-guest-layout>