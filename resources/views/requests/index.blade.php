<x-app-layout>
    <div class="mb-10">
        <h1 class="text-3xl font-bold tracking-tight text-piano">Service Requests</h1>
        <p class="text-piano/60 mt-1">Review and manage your service requests.</p>
    </div>

    <div class="bg-pearl rounded-2xl border border-piano/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-[#F8F9FA] border-b border-piano/10">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">Details</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">{{ auth()->user()->isWorker() ? 'Client' : 'Professional' }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">Schedule</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-piano/5">
                    @forelse($requests as $req)
                        <tr class="hover:bg-piano/5 transition-colors">
                            <td class="px-6 py-5">
                                <div class="font-bold text-piano">{{ $req->service->title }}</div>
                                <div class="text-xs text-piano/50 mt-1">Requested {{ $req->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-5 font-medium text-piano">
                                @if(auth()->user()->isWorker())
                                    {{ $req->customer->name }}
                                @else
                                    <a href="{{ route('worker.profile', $req->service->user) }}" class="hover:underline">
                                        {{ $req->service->user->name }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-sm font-semibold text-piano">
                                {{ $req->scheduled_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full 
                                    @if($req->status === 'pending') bg-piano/10 text-piano 
                                    @elseif($req->status === 'accepted') bg-piano text-pearl 
                                    @elseif($req->status === 'completed') bg-success/20 text-success 
                                    @else bg-failure/20 text-failure @endif">
                                    {{ $req->status }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <a href="{{ route('requests.show', $req) }}" class="btn-outline px-4 py-1.5 text-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-piano/50 font-medium">No requests to display yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">
        {{ $requests->links() }}
    </div>
</x-app-layout>