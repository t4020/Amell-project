<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function workerProfile() {
        return $this->hasOne(WorkerProfile::class);
    }

    public function services() {
        return $this->hasMany(Service::class);
    }

    public function customerRequests() {
        return $this->hasMany(ServiceRequest::class, 'customer_id');
    }

    public function reviewsReceived() {
        return $this->hasMany(Review::class, 'worker_id');
    }

    public function isWorker() {
        return $this->role === 'worker';
    }

    public function isCustomer() {
        return $this->role === 'customer';
    }
}