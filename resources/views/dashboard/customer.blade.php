<x-app-layout>
    <div class="mb-10">
        <h1 class="text-3xl font-bold tracking-tight text-piano">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-piano/60 mt-1">Track your service requests and communicate with professionals.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-pearl p-6 rounded-2xl border border-piano/10 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-piano/5 flex items-center justify-center">
                <svg class="w-6 h-6 text-piano" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <div class="text-2xl font-black text-piano">{{ auth()->user()->customerRequests()->count() }}</div>
                <div class="text-sm font-medium text-piano/50">Total Requests</div>
            </div>
        </div>
    </div>

    <div class="bg-pearl rounded-2xl border border-piano/10 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-piano/5 flex justify-between items-center bg-[#F8F9FA]">
            <h2 class="text-lg font-bold text-piano">Recent Requests</h2>
            <a href="{{ route('requests.index') }}" class="text-sm font-semibold text-piano hover:underline">View All &rarr;</a>
        </div>
        <div class="divide-y divide-piano/5">
            @forelse($requests as $request)
                <div class="p-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4 hover:bg-piano/5 transition-colors">
                    <div>
                        <div class="text-xs font-bold text-piano/50 mb-1">{{ $request->scheduled_date->format('M d, Y') }}</div>
                        <h3 class="font-bold text-piano text-lg">{{ $request->service->title }}</h3>
                        <p class="text-sm text-piano/60 mt-1 flex items-center gap-2">
                            <span>Professional:</span>
                            <a href="{{ route('worker.profile', $request->service->user) }}" class="font-semibold text-piano hover:underline">{{ $request->service->user->name }}</a>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full 
                            @if($request->status === 'pending') bg-piano/10 text-piano 
                            @elseif($request->status === 'accepted') bg-piano text-pearl 
                            @elseif($request->status === 'completed') bg-success/20 text-success 
                            @else bg-failure/20 text-failure @endif">
                            {{ $request->status }}
                        </span>
                        <a href="{{ route('requests.show', $request) }}" class="btn-outline px-4 py-1.5 text-sm">View</a>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <p class="text-piano/50 mb-4 font-medium">You haven't made any requests yet.</p>
                    <a href="{{ route('explore') }}" class="btn-piano inline-block">Explore Services</a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>