<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'date',
        'time',
        'mentor_id',
        'candidate_id',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function mentorAssigned()
    {
        return $this->belongsTo(MentorAssigned::class, 'mentor_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}
