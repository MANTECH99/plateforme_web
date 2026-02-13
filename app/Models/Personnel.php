<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [
        'user_id',
        'photo_path',
        'job_title',
        'experience_years',
        'description',
        'availability',
        'city',
        'desired_salary',
        'certified',
        'career_path',
        'work_history',
        'skills',
    ];

    protected function casts(): array
    {
        return [
            'certified' => 'boolean',
            'experience_years' => 'integer',
            'desired_salary' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class);
    }
}
