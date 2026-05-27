<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamEnrollment extends Model
{
    protected $fillable = [
        'exam_id', 'user_id', 'status',
        'had_stage_last_year', 'result', 'admin_note',
    ];

    protected $casts = [
        'had_stage_last_year' => 'boolean',
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
