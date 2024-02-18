<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverRoute extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    public function reservations() {
        return $this->hasMany(Reservation::class, 'route_id', 'id');
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }

    public function route() {
        return $this->belongsTo(Route::class);
    }
}
