<?php

namespace App\Models;

use App\Models\Traits\BelongsToTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    use HasFactory;
    use BelongsToTrait;
}
