<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-piano">Services</h1>
            <p class="text-piano/60 mt-1">Create, update, and manage the services you offer.</p>
        </div>
        <a href="{{ route('services.create') }}" class="btn-piano">Add New Service</a>
    </div>

    <div class="bg-pearl rounded-2xl border border-piano/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-[#F8F9FA] border-b border-piano/10">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">Service Details</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">Category</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50">Price</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-piano/50 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-piano/5">
                    @forelse($services as $service)
                        <tr class="hover:bg-piano/5 transition-colors">
                            <td class="px-6 py-5">
                                <div class="font-bold text-piano">{{ $service->title }}</div>
                                <div class="text-xs text-piano/50 mt-1">Listed {{ $service->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-piano/5 text-piano text-xs font-bold rounded-md">{{ $service->category->name }}</span>
                            </td>
                            <td class="px-6 py-5 font-bold text-piano">
                                ${{ number_format($service->price, 2) }}
                            </td>
                            <td class="px-6 py-5 text-right flex justify-end gap-3">
                                <a href="{{ route('services.edit', $service) }}" class="text-piano/60 hover:text-piano font-semibold text-sm transition-colors">Edit</a>
                                <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-failure hover:text-failure/70 font-semibold text-sm transition-colors">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-piano/50 font-medium">No services yet. Create your first listing.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">
        {{ $services->links() }}
    </div>
</x-app-layout>