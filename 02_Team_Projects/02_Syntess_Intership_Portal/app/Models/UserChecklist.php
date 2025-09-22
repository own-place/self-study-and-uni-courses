<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChecklist extends Model
{
    use HasFactory;

    protected $table = 'user_checklist';

    protected $fillable = ['user_id', 'item_key', 'completed'];
}
