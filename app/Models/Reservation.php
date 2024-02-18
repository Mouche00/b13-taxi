<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function route() {
        return $this->belongsTo(DriverRoute::class, 'route_id', 'id');
    }

    public function passenger() {
        return $this->belongsTo(Passenger::class);
    }

    public function review() {
        return $this->hasOne(Review::class);
    }
}
