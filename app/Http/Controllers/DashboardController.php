<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller {
    public function index(): View|RedirectResponse {
        $user = auth()->user();

        if ($user->isWorker()) {
            $services = $user->services()->latest()->get();
            $recentRequests = $user->services()->with('requests.customer')->get()->pluck('requests')->flatten()->sortByDesc('created_at')->take(5);
            return view('dashboard.worker', compact('services', 'recentRequests'));
        }

        $requests = $user->customerRequests()->with('service.user')->latest()->take(5)->get();
        return view('dashboard.customer', compact('requests'));
    }
}