<?php

namespace App\Models;

use App\Models\Traits\BelongsToTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Route;

class Driver extends User
{
    use HasFactory;
    use BelongsToTrait;

    protected $guarded = [];

    public function routes() {
        return $this->hasMany(Route::class);
    }
}
