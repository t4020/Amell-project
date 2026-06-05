<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Http\Requests\StoreServiceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller {
    public function index(): View {
        $services = auth()->user()->services()->with('category')->latest()->paginate(10);
        return view('services.index', compact('services'));
    }

    public function create(): View {
        $categories = Category::all();
        return view('services.create', compact('categories'));
    }

    public function store(StoreServiceRequest $request): RedirectResponse {
        auth()->user()->services()->create($request->validated());
        return redirect()->route('dashboard')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View {
        abort_if($service->user_id != auth()->id(), 403);
        $categories = Category::all();
        return view('services.create', compact('service', 'categories'));
    }

    public function update(StoreServiceRequest $request, Service $service): RedirectResponse {
        abort_if($service->user_id != auth()->id(), 403);
        $service->update($request->validated());
        return redirect()->route('dashboard')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse {
        abort_if($service->user_id != auth()->id(), 403);
        $service->delete();
        return redirect()->route('dashboard')->with('success', 'Service removed.');
    }
}