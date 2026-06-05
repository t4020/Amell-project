<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestRequest extends FormRequest {
    public function authorize(): bool {
        return auth()->user()->isCustomer();
    }

    public function rules(): array {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'description' => ['required', 'string', 'max:2000'],
            'scheduled_date' => ['required', 'date', 'after:today'],
        ];
    }
}