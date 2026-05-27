<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    protected $fillable = [
        'title', 'date', 'location', 'description',
        'instructor', 'created_by', 'registration_deadline',
    ];

    protected $casts = [
        'date'                  => 'date',
        'registration_deadline' => 'date',
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(StageEnrollment::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isPast(): bool
    {
        return $this->date->isPast();
    }

    public function registrationOpen(): bool
    {
        if ($this->isPast()) {
            return false;
        }
        if ($this->registration_deadline && now()->isAfter($this->registration_deadline)) {
            return false;
        }
        return true;
    }
}
