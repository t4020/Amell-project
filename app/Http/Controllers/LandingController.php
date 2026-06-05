<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller {
    public function index(): View {
        $categories = Category::take(6)->get();
        $topWorkers = User::where('role', 'worker')->with('workerProfile', 'reviewsReceived')->withCount('reviewsReceived')->orderByDesc('reviews_received_count')->take(4)->get();
        return view('public.landing', compact('categories', 'topWorkers'));
    }

    public function explore(Request $request): View {
        $search = $request->string('q')->trim()->toString();
        $serviceId = $request->integer('service') ?: null;

        if ($serviceId && ! Service::whereKey($serviceId)->exists()) {
            $serviceId = null;
        }

        $catalogServices = Service::with('category')->orderBy('title')->get();

        $servicesQuery = Service::with('user.workerProfile', 'category')->latest();

        if ($serviceId) {
            $servicesQuery->whereKey($serviceId);
        }

        if ($search !== '') {
            $servicesQuery->where(function ($q) use ($search) {
                $like = '%'.$search.'%';
                $q->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like);
            });
        }

        $services = $servicesQuery->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('public.explore', compact('services', 'categories', 'catalogServices'));
    }

    public function category(Category $category): View {
        $services = $category->services()->with('user.workerProfile')->paginate(12);
        return view('public.category', compact('category', 'services'));
    }
}