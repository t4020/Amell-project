<x-app-layout>
    <div class="mb-10">
        <a href="{{ route('explore') }}" class="text-sm font-bold text-piano/50 hover:text-piano transition-colors">&larr; Back to services</a>
        <h1 class="text-3xl font-bold tracking-tight text-piano mt-4">Request service</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-pearl border border-piano/10 rounded-2xl p-8 shadow-sm">
            <form action="{{ route('requests.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <div>
                    <label for="scheduled_date" class="block text-sm font-bold text-piano mb-2">Target Date</label>
                    <input type="date" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date') }}" class="w-full md:w-1/2 bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent transition-shadow text-piano" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-piano mb-2">Specific Requirements</label>
                    <textarea id="description" name="description" rows="5" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent transition-shadow text-piano resize-none" placeholder="Describe what you need, including any constraints, preferences, and context." required>{{ old('description') }}</textarea>
                </div>

                <div class="pt-4 border-t border-piano/5 flex justify-end">
                    <button type="submit" class="btn-piano w-full md:w-auto">Submit request</button>
                </div>
            </form>
        </div>

        <div class="bg-piano text-pearl rounded-2xl p-8 h-fit border border-piano/20">
            <div class="text-xs font-bold text-pearl/50 uppercase tracking-wider mb-2">Subject Service</div>
            <h3 class="text-xl font-bold mb-4">{{ $service->title }}</h3>
            <div class="text-2xl font-black mb-6">${{ number_format($service->price, 2) }}</div>
            
            <div class="border-t border-pearl/10 pt-6">
                <div class="text-xs font-bold text-pearl/50 uppercase tracking-wider mb-3">The Professional</div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pearl text-piano font-black flex items-center justify-center rounded-full">
                        {{ substr($service->user->name, 0, 1) }}
                    </div>
                    <div>
                        <a href="{{ route('worker.profile', $service->user) }}" class="font-bold hover:underline">{{ $service->user->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>