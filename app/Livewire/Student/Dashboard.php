<?php

namespace App\Livewire\Student;

use App\Models\Grade;
use App\Models\StudentProgress;
use App\Models\Technique;
use Livewire\Component;

class Dashboard extends Component
{
    public function cycleStatus(int $techniqueId): void
    {
        $user     = auth()->user();
        $progress = StudentProgress::where('user_id', $user->id)
            ->where('technique_id', $techniqueId)
            ->first();

        if (! $progress) {
            StudentProgress::create([
                'user_id'      => $user->id,
                'technique_id' => $techniqueId,
                'status'       => 'progress',
            ]);
        } elseif ($progress->status === 'progress') {
            $progress->update(['status' => 'mastered']);
        } else {
            $progress->delete();
        }
    }

    public function render()
    {
        $user = auth()->user();

        $grades = Grade::with([
            'categories' => fn ($q) => $q->orderBy('order')->with([
                'techniques' => fn ($q) => $q->orderBy('order'),
            ]),
        ])->orderBy('order')->get();

        $progressMap = StudentProgress::where('user_id', $user->id)
            ->pluck('status', 'technique_id')
            ->all();

        $totalCount    = $grades->sum(fn ($g) => $g->categories->sum(fn ($c) => $c->techniques->count()));
        $masteredCount = collect($progressMap)->filter(fn ($s) => $s === 'mastered')->count();
        $progressCount = collect($progressMap)->filter(fn ($s) => $s === 'progress')->count();
        $unknownCount  = $totalCount - $masteredCount - $progressCount;

        $lastProgressTechId = collect($progressMap)->filter(fn ($s) => $s === 'progress')->keys()->first();
        $lastProgress       = $lastProgressTechId
            ? Technique::with('category')->find($lastProgressTechId)
            : null;

        return view('livewire.student.dashboard', [
            'user'          => $user,
            'grades'        => $grades,
            'progressMap'   => $progressMap,
            'masteredCount' => $masteredCount,
            'progressCount' => $progressCount,
            'unknownCount'  => $unknownCount,
            'totalCount'    => $totalCount,
            'lastProgress'  => $lastProgress,
        ])->layout('components.layouts.app', ['title' => 'Dashboard']);
    }
}
