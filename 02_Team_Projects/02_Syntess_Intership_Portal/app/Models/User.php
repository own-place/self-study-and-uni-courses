<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => ucwords(strtolower($this->first_name))." ".ucwords(strtolower($this->last_name))
        );
    }

    public function checklist()
    {
        return $this->hasMany(UserChecklist::class);
    }
    public function application(): HasOne
    {
        return $this->hasOne(Application::class);
    }


    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function hobbies(): HasMany
    {
        return $this->hasMany(Hobby::class);
    }

      public function messages(): HasMany
    {
        return $this->hasMany(MentorMessage::class, 'user_id', 'id');
    }
    /**
     * Define the relationship with mentors.
     */
    public function assignedMentor()
    {
        return $this->hasOne(MentorAssigned::class, 'student_id');
    }

    /**
     * Define the relationship with candidates.
     */
    public function assignedStudents(): HasMany
    {
        return $this->hasMany(MentorAssigned::class, 'mentor_id');
    }

    /**
     * Define the relationship with candidates.
     */
    public function candidates()
    {
        return $this->belongsToMany(User::class, 'mentor_assigned', 'mentor_id', 'candidate_id')
            ->withTimestamps();
    }

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Internship::class, 'reviews', 'user_id', 'internship_id')
            ->using(Review::class)
            ->withPivot('rating', 'review', 'anonymous')
            ->withTimestamps();
    }
}
