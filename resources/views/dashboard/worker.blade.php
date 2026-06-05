<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-piano">Professional Dashboard</h1>
            <p class="text-piano/60 mt-1">Welcome back, {{ auth()->user()->name }}.</p>
        </div>
        <a href="{{ route('services.create') }}" class="btn-piano inline-flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            List New Service
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-pearl p-6 rounded-2xl border border-piano/10 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-piano/5 flex items-center justify-center">
                <svg class="w-6 h-6 text-piano" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="text-2xl font-black text-piano">{{ $services->count() }}</div>
                <div class="text-sm font-medium text-piano/50">Active Services</div>
            </div>
        </div>
    </div>

    <div class="bg-pearl rounded-2xl border border-piano/10 shadow-sm overflow-hidden mb-10">
        <div class="px-6 py-5 border-b border-piano/5 flex justify-between items-center bg-[#F8F9FA]">
            <h2 class="text-lg font-bold text-piano">Incoming Requests</h2>
            <a href="{{ route('requests.index') }}" class="text-sm font-semibold text-piano hover:underline">View All &rarr;</a>
        </div>
        <div class="divide-y divide-piano/5">
            @forelse($recentRequests as $req)
                <div class="p-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4 hover:bg-piano/5 transition-colors">
                    <div>
                        <div class="text-xs font-bold text-piano/50 mb-1">Due: {{ $req->scheduled_date->format('M d, Y') }}</div>
                        <h3 class="font-bold text-piano text-lg">{{ $req->service->title }}</h3>
                        <p class="text-sm text-piano/60 mt-1 flex items-center gap-2">
                            <span>Client:</span>
                            <a href="{{ route('worker.profile', $req->customer) }}" class="font-semibold text-piano hover:underline">{{ $req->customer->name }}</a>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full 
                            @if($req->status === 'pending') bg-piano/10 text-piano 
                            @elseif($req->status === 'accepted') bg-piano text-pearl 
                            @elseif($req->status === 'completed') bg-success/20 text-success 
                            @else bg-failure/20 text-failure @endif">
                            {{ $req->status }}
                        </span>
                        <a href="{{ route('requests.show', $req) }}" class="btn-outline px-4 py-1.5 text-sm">Manage</a>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <p class="text-piano/50 mb-4 font-medium">There are no incoming requests at this time.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>