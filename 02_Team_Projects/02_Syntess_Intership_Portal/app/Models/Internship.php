<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'year_level_id', 'language_id', 'category_id', 'salary', 'passed',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reviews',
            'internship_id', 'user_id')
            ->using(Review::class)
            ->withPivot('rating', 'review', 'anonymous')
            ->withTimestamps();
    }

    public function avgRating(): Attribute
    {
        return Attribute::make(
            get: function () {
                $reviews = Review::query()
                    ->where('internship_id', '=', $this->id)
                    ->pluck('rating')
                    ->toArray();
                return (count($reviews) > 0 ? round(array_sum($reviews)/count($reviews), 2) : 0);
            }
        );
    }
}
