<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';

    protected $fillable = [
        'current_step',
        'preference',
        'graduation',
        'user_id',
        'internship_id',
        'cv',
        'resume',
        'cover_letter',
        'letter_of_enrollment',
        'letter_of_recommendation',
        'letter_of_enrollment',
        'preference',
        'graduation',
        'internship_id',
        'status',
        'preference',
        'graduation',
        'internship_id',
        'final_approval',
        'contract_document',
        'contract_start_date',
        'contract_end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function interview()
    {
        return $this->hasOne(Interview::class);
    }

    public function assignedMentor()
    {
        return $this->belongsTo(MentorAssigned::class, 'mentor_id');
    }
}
