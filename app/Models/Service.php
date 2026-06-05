<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $guarded = [];

    protected $casts = [
        'user_id'     => 'integer',
        'category_id' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function requests() {
        return $this->hasMany(ServiceRequest::class);
    }
}