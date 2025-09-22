<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    public const ADMIN = 1;
    public const MENTOR = 2;
    public const INTERN = 3;
    public const STUDENT = 4;
    public const CANDIDATE = 5;
    public const HR = 6;

    protected function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
