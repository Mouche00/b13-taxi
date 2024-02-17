<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverRoute extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
