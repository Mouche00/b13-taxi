<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Route extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function drivers() {
        return $this->belongsToMany(Driver::class)->using(DriverRoute::class)->withTimestamps();
    }

    public function reservation() {
        return $this->hasOne(Reservation::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['departure'] ?? false, fn($query, $departure) =>
            $query->when($filters['destination'] ?? false, fn($query, $destination) =>
                $query->where('departure', $departure)->where('destination', $destination)
            )
        );
    }
}
