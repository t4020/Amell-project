<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller {
    public function store(StoreReviewRequest $request): RedirectResponse {
        $serviceRequest = ServiceRequest::findOrFail($request->service_request_id);
        
        abort_if($serviceRequest->customer_id !== auth()->id() || $serviceRequest->status !== 'completed', 403);
        abort_if($serviceRequest->review()->exists(), 403);

        $serviceRequest->review()->create([
            'customer_id' => auth()->id(),
            'worker_id' => $serviceRequest->service->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('requests.show', $serviceRequest)->with('success', 'Review submitted.');
    }
}