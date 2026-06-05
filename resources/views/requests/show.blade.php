<x-app-layout>
    <div class="mb-10">
        <a href="{{ route('requests.index') }}" class="text-sm font-bold text-piano/50 hover:text-piano transition-colors">&larr; All Requests</a>
        <h1 class="text-3xl font-bold tracking-tight text-piano mt-4">Request Details</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <div class="lg:col-span-2 bg-pearl border border-piano/10 rounded-2xl p-8 shadow-sm">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-piano">{{ $serviceRequest->service->title }}</h2>
                    <p class="text-sm text-piano/50 mt-1 font-medium">Reference #{{ str_pad($serviceRequest->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <span class="px-4 py-1.5 text-xs font-bold uppercase tracking-wider rounded-full 
                    @if($serviceRequest->status === 'pending') bg-piano/10 text-piano 
                    @elseif($serviceRequest->status === 'accepted') bg-piano text-pearl 
                    @elseif($serviceRequest->status === 'completed') bg-success/20 text-success 
                    @else bg-failure/20 text-failure @endif">
                    {{ $serviceRequest->status }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-8 py-6 border-y border-piano/5">
                <div>
                    <div class="text-xs font-bold text-piano/50 uppercase tracking-wider mb-1">Scheduled Date</div>
                    <div class="font-bold text-piano text-lg">{{ $serviceRequest->scheduled_date->format('l, M d, Y') }}</div>
                </div>
                <div>
                    <div class="text-xs font-bold text-piano/50 uppercase tracking-wider mb-1">Base Price</div>
                    <div class="font-bold text-piano text-lg">${{ number_format($serviceRequest->service->price, 2) }}</div>
                </div>
            </div>

            <div class="mb-8">
                <div class="text-xs font-bold text-piano/50 uppercase tracking-wider mb-3">Client Requirements</div>
                <p class="text-piano/80 leading-relaxed bg-[#F8F9FA] p-5 rounded-xl border border-piano/5 whitespace-pre-line">{{ $serviceRequest->description }}</p>
            </div>

            @if($isWorker && $serviceRequest->status !== 'completed' && $serviceRequest->status !== 'rejected')
                <div class="pt-6 border-t border-piano/5 bg-piano/5 -mx-8 -mb-8 p-8 rounded-b-2xl">
                    <h3 class="font-bold text-piano mb-4">Update Status</h3>
                    <form action="{{ route('requests.status', $serviceRequest) }}" method="POST" class="flex gap-4">
                        @csrf @method('PATCH')
                        @if($serviceRequest->status === 'pending')
                            <button type="submit" name="status" value="accepted" class="btn-piano">Accept Request</button>
                            <button type="submit" name="status" value="rejected" class="btn-outline bg-pearl border-failure text-failure hover:bg-failure hover:border-failure">Reject</button>
                        @elseif($serviceRequest->status === 'accepted')
                            <button type="submit" name="status" value="completed" class="bg-success text-pearl px-6 py-2.5 rounded-lg font-bold hover:bg-success/80 transition-colors">Mark as Completed</button>
                        @endif
                    </form>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-pearl border border-piano/10 rounded-2xl p-6 shadow-sm">
                <h3 class="text-xs font-bold text-piano/50 uppercase tracking-wider mb-4 border-b border-piano/5 pb-2">Involved Parties</h3>
                
                <div class="mb-5">
                    <div class="text-[10px] font-bold text-piano/40 uppercase mb-2">Professional</div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-piano text-pearl flex items-center justify-center text-xs font-bold">{{ substr($serviceRequest->service->user->name, 0, 1) }}</div>
                        <a href="{{ route('worker.profile', $serviceRequest->service->user) }}" class="font-semibold text-piano text-sm hover:underline">{{ $serviceRequest->service->user->name }}</a>
                    </div>
                </div>

                <div>
                    <div class="text-[10px] font-bold text-piano/40 uppercase mb-2">Client</div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-piano/10 text-piano flex items-center justify-center text-xs font-bold">{{ substr($serviceRequest->customer->name, 0, 1) }}</div>
                        <div class="font-semibold text-piano text-sm">{{ $serviceRequest->customer->name }}</div>
                    </div>
                </div>
            </div>

            @if($isCustomer && $serviceRequest->status === 'completed' && !$serviceRequest->review)
                <div class="bg-piano text-pearl border border-piano/10 rounded-2xl p-6 shadow-xl">
                    <h3 class="font-bold mb-4">Leave a Review</h3>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_request_id" value="{{ $serviceRequest->id }}">
                        
                        <select name="rating" class="w-full bg-pearl/10 border border-pearl/20 rounded-xl px-4 py-2 mb-4 text-pearl focus:ring-pearl focus:border-pearl outline-none" required>
                            <option value="" class="text-piano">Select Rating</option>
                            <option value="5" class="text-piano">5 - Excellent</option>
                            <option value="4" class="text-piano">4 - Very good</option>
                            <option value="3" class="text-piano">3 - Good</option>
                            <option value="2" class="text-piano">2 - Fair</option>
                            <option value="1" class="text-piano">1 - Poor</option>
                        </select>

                        <textarea name="comment" rows="3" class="w-full bg-pearl/10 border border-pearl/20 rounded-xl px-4 py-2 mb-4 text-pearl focus:ring-pearl focus:border-pearl outline-none resize-none placeholder:text-pearl/40" placeholder="Optional comments..."></textarea>
                        
                        <button type="submit" class="w-full bg-pearl text-piano font-bold py-2 rounded-lg hover:bg-pearl/80 transition-colors">Submit Review</button>
                    </form>
                </div>
            @endif

            @if($serviceRequest->review)
                <div class="bg-pearl border border-piano/10 rounded-2xl p-6 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-success"></div>
                    <h3 class="text-xs font-bold text-piano/50 uppercase tracking-wider mb-4">Review</h3>
                    <div class="flex gap-1 text-success mb-2">
                        @for($i = 0; $i < $serviceRequest->review->rating; $i++)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <p class="text-piano/80 text-sm italic">"{{ $serviceRequest->review->comment }}"</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>