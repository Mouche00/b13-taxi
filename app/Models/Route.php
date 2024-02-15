<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Route extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['departure'] ?? false, fn($query, $departure) =>
            $query->when($filters['destination'] ?? false, fn($query, $destination) =>
                $query->where('departure', $departure)->where('destination', $destination)
            )
        );
    }
}
