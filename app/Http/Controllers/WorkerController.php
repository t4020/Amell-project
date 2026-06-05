<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class WorkerController extends Controller {
    public function show(User $user): View {
        abort_if(!$user->isWorker(), 404);
        
        $user->load('workerProfile', 'services.category', 'reviewsReceived.customer');
        $averageRating = $user->reviewsReceived()->avg('rating') ?? 0;
        
        return view('public.worker-profile', compact('user', 'averageRating'));
    }
}