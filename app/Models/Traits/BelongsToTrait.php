<?php

namespace App\Models\Traits;

use App\Models\User;

trait BelongsToTrait {

    public function user() {
        return $this->belongsTo(User::class);
    }
}
