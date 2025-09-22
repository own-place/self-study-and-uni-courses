<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorMessage extends Model
{
    use HasFactory;

    protected $table = 'chat';

    protected $guarded = ['id'];

    protected function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
