<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Service;
use App\Http\Requests\StoreRequestRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller {
    public function index(): View {
        $user = auth()->user();

        if ($user->isCustomer()) {
            $requests = $user->customerRequests()->with('service.user')->latest()->paginate(10);
        } else {
            $requests = ServiceRequest::whereIn('service_id', $user->services()->pluck('id'))
                ->with('customer', 'service')
                ->latest()
                ->paginate(10);
        }

        return view('requests.index', compact('requests'));
    }

    public function create(Request $request): View {
        $service = Service::with('user')->findOrFail($request->service_id);
        return view('requests.create', compact('service'));
    }

    public function store(StoreRequestRequest $request): RedirectResponse {
        auth()->user()->customerRequests()->create($request->validated());
        return redirect()->route('requests.index')->with('success', 'Service requested successfully.');
    }

    public function show(ServiceRequest $serviceRequest): View {
        $serviceRequest->load('service.user', 'customer', 'review');

        $user        = auth()->user();
        $isCustomer  = $serviceRequest->customer_id === $user->id;
        $isWorker    = $serviceRequest->service?->user_id === $user->id;

        \Log::debug('RequestController@show access check', [
            'service_request_id' => $serviceRequest->id,
            'service_id' => $serviceRequest->service_id,
            'service_user_id' => $serviceRequest->service?->user_id,
            'customer_id' => $serviceRequest->customer_id,
            'auth_user_id' => $user->id,
            'auth_user_role' => $user->role,
            'isCustomer' => $isCustomer,
            'isWorker' => $isWorker,
        ]);

        abort_if(!$isCustomer && !$isWorker, 403);

        return view('requests.show', compact('serviceRequest', 'isCustomer', 'isWorker'));
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest): RedirectResponse {
        abort_if($serviceRequest->service?->user_id !== auth()->id(), 403);

        $request->validate(['status' => 'required|in:accepted,rejected,completed']);
        $serviceRequest->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated.');
    }
}
