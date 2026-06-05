<x-app-layout>
    <div class="mb-10">
        <a href="{{ route('services.index') }}" class="text-sm font-bold text-piano/50 hover:text-piano transition-colors">&larr; Back to Services</a>
        <h1 class="text-3xl font-bold tracking-tight text-piano mt-4">{{ isset($service) ? 'Edit service' : 'Create a service' }}</h1>
    </div>

    <div class="bg-pearl border border-piano/10 rounded-2xl p-8 max-w-3xl shadow-sm">
        <form action="{{ isset($service) ? route('services.update', $service) : route('services.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($service)) @method('PUT') @endif

            <div>
                <label for="title" class="block text-sm font-bold text-piano mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent transition-shadow text-piano" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category_id" class="block text-sm font-bold text-piano mb-2">Category</label>
                    <select id="category_id" name="category_id" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent transition-shadow text-piano appearance-none" required>
                        <option value="">Select a category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $service->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price" class="block text-sm font-bold text-piano mb-2">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $service->price ?? '') }}" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent transition-shadow text-piano" required>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-piano mb-2">Description</label>
                <textarea id="description" name="description" rows="5" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano focus:border-transparent transition-shadow text-piano resize-none" required>{{ old('description', $service->description ?? '') }}</textarea>
                <p class="text-xs text-piano/40 mt-2">Include deliverables, timeline expectations, and what is included in the price.</p>
            </div>

            <div class="pt-4 border-t border-piano/5 flex justify-end">
                <button type="submit" class="btn-piano w-full md:w-auto">
                    {{ isset($service) ? 'Save changes' : 'Publish service' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>