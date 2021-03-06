<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Register extends Model
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
