<?php

namespace App\Models;

use App\Models\Traits\OneToOneTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    use OneToOneTrait;

    protected $guarded = [];
}
