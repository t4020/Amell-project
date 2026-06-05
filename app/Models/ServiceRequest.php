<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model {
    protected $guarded = [];

    protected $casts = [
        'scheduled_date' => 'date',
        'customer_id'    => 'integer',
        'service_id'     => 'integer',
    ];

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function review() {
        return $this->hasOne(Review::class);
    }
}