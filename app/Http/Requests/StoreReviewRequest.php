<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ServiceRequest;

class StoreReviewRequest extends FormRequest {
    public function authorize(): bool {
        return auth()->user()->isCustomer();
    }

    public function rules(): array {
        return [
            'service_request_id' => ['required', 'exists:service_requests,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }
}