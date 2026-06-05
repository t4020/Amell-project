<x-guest-layout>
    <div class="bg-piano py-16 border-b border-piano/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-pearl mb-4">{{ $category->name }} Services</h1>
            <p class="text-xl text-pearl/60 max-w-2xl mx-auto">Browse vetted providers in {{ strtolower($category->name) }}.</p>
            <a href="{{ route('explore') }}" class="inline-block mt-8 text-pearl/60 hover:text-pearl font-medium underline transition-colors">&larr; Back to all services</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 animate-fade-in">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($services as $service)
                    <div class="bg-pearl border border-piano/10 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                        <div class="p-6 flex-grow">
                            <h3 class="font-bold text-xl text-piano mb-3 leading-snug group-hover:text-piano/70 transition-colors">{{ $service->title }}</h3>
                            <p class="text-piano/60 text-sm line-clamp-3 mb-6">{{ $service->description }}</p>
                        </div>
                        <div class="px-6 py-5 bg-[#F8F9FA] border-t border-piano/5 flex items-center justify-between mt-auto">
                            <a href="{{ route('worker.profile', $service->user) }}" class="flex items-center gap-2 group/worker">
                                <div class="w-8 h-8 rounded-full bg-piano text-pearl flex items-center justify-center text-xs font-bold">
                                    {{ substr($service->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-semibold text-piano group-hover/worker:underline">{{ $service->user->name }}</span>
                            </a>
                            <span class="font-bold text-lg text-piano">${{ number_format($service->price, 2) }}</span>
                        </div>
                        <a href="{{ route('requests.create', ['service_id' => $service->id]) }}" class="block w-full text-center bg-piano text-pearl py-3 font-semibold hover:bg-piano/90 transition-colors">
                            Request Service
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-12">
                {{ $services->links() }}
            </div>
        @else
            <div class="text-center py-20 border border-dashed border-piano/20 rounded-3xl">
                <h3 class="text-2xl font-bold text-piano mb-2">No Services Yet</h3>
                <p class="text-piano/60">There are no listings in this category yet.</p>
            </div>
        @endif
    </div>
</x-guest-layout>