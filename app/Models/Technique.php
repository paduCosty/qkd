<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Technique extends Model
{
    protected $fillable = [
        'category_id',
        'name_viet',
        'name_ro',
        'type',
        'description',
        'key_points',
        'coach_note',
        'video_url',
        'steps',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'key_points' => 'array',
            'steps'      => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }

    public function youtubeEmbedUrl(): ?string
    {
        if (! $this->video_url) {
            return null;
        }

        $patterns = [
            '/[?&]v=([a-zA-Z0-9_-]{11})/',
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/',
            '/\/embed\/([a-zA-Z0-9_-]{11})/',
            '/\/shorts\/([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $this->video_url, $m)) {
                return 'https://www.youtube.com/embed/' . $m[1];
            }
        }

        return null;
    }

    public function isLocalVideo(): bool
    {
        return $this->video_url && str_starts_with($this->video_url, 'storage/');
    }

    public function isForm(): bool
    {
        return $this->type === 'form';
    }
}
