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
}
