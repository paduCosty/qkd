<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['grade_id', 'name_viet', 'name_ro', 'order'];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function techniques(): HasMany
    {
        return $this->hasMany(Technique::class)->orderBy('order');
    }
}
