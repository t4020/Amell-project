<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    protected $guarded = [];

    protected $casts = [
        'customer_id'        => 'integer',
        'worker_id'          => 'integer',
        'service_request_id' => 'integer',
    ];

    public function serviceRequest() {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function worker() {
        return $this->belongsTo(User::class, 'worker_id');
    }
}