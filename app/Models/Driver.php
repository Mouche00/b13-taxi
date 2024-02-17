<?php

namespace App\Models;

use App\Models\Traits\BelongsToTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Route;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends User
{
    use HasFactory;
    use BelongsToTrait;
    use SoftDeletes;

    protected $guarded = [];

    public function routes() {
        return $this->belongsToMany(Route::class)->using(DriverRoute::class)->withPivot(['id', 'selected'])->withTimestamps();
    }

    public function currentRoute() {
        return $this->belongsToMany(Route::class)->using(DriverRoute::class)->withPivot(['id', 'selected'])->wherePivot('selected', '1')->withTimestamps();
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['departure'] ?? false, fn($query, $departure) =>
            $query->when($filters['destination'] ?? false, fn($query, $destination) =>
                $query
                ->whereHas('currentRoute', fn($query) => $query->where('departure', $departure))
                ->whereHas('currentRoute', fn($query) => $query->where('destination', $destination))
            )
        );
    }
}
