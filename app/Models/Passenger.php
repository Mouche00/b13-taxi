<?php

namespace App\Models;

use App\Models\Traits\BelongsToTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passenger extends User
{
    use HasFactory;
    use BelongsToTrait;
    use SoftDeletes;

    protected $guarded = [];

    public function reservation() {
        return $this->hasOne(Reservation::class);
    }

}
