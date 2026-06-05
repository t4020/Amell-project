<x-guest-layout>
    <section class="relative bg-pearl overflow-hidden pt-24 pb-32">
        <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] opacity-40"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center animate-fade-in">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-piano mb-6 leading-tight">
                Professional services, <br> <span class="text-piano/50">delivered with confidence.</span>
            </h1>
            <p class="mt-4 text-xl md:text-2xl text-piano/70 max-w-3xl mx-auto mb-10 font-light">
                Amel connects customers with vetted professionals for household, technical, and business services—clear pricing, transparent communication, and reliable delivery.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('explore') }}" class="btn-piano {background-color:text-lg px-8 py-4">Explore Services</a>
                <a href="{{ route('register') }}" class="btn-outline text-lg px-8 py-4 bg-pearl">Create an account</a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-piano text-pearl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 tracking-tight">Popular Categories</h2>
            @if($categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="group block p-6 border border-pearl/20 rounded-2xl hover:bg-pearl hover:text-piano transition-all duration-300 text-center">
                            <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                            <p class="text-sm opacity-60 group-hover:opacity-100 mt-2 transition-opacity">Explore &rarr;</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-pearl/60 text-lg">Categories will appear here once they are available.</p>
            @endif
        </div>
    </section>

    <section class="py-24 bg-pearl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-piano">Featured Professionals</h2>
                    <p class="text-piano/60 mt-2 text-lg">Highly rated providers with strong client feedback.</p>
                </div>
            </div>

            @if($topWorkers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($topWorkers as $worker)
                        <a href="{{ route('worker.profile', $worker) }}" class="group bg-pearl border border-piano/10 rounded-2xl p-6 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 block">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-16 h-16 rounded-full bg-piano text-pearl flex items-center justify-center text-2xl font-bold">
                                    {{ substr($worker->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-piano group-hover:text-piano/70 transition-colors">{{ $worker->name }}</h3>
                                    <div class="flex items-center text-success font-medium text-sm gap-1 mt-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        {{ $worker->reviews_received_count > 0 ? number_format($worker->reviewsReceived->avg('rating'), 1) : 'New' }}
                                        <span class="text-piano/40 font-normal">({{ $worker->reviews_received_count }})</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-piano/70 text-sm line-clamp-3">
                                {{ $worker->workerProfile->bio ?? 'An exceptionally skilled professional offering premium services.' }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-piano/60 text-lg">No professionals are listed yet. Check back soon.</p>
            @endif
        </div>
    </section>
</x-guest-layout>