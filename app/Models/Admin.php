<?php

namespace App\Models;

use App\Models\Traits\BelongsToTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends User
{
    use HasFactory;
    use BelongsToTrait;
    use SoftDeletes;
}
