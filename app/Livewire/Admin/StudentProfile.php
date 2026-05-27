<?php

namespace App\Livewire\Admin;

use App\Models\ExamEnrollment;
use App\Models\Grade;
use App\Models\StageEnrollment;
use App\Models\StudentProgress;
use App\Models\User;
use Livewire\Component;

class StudentProfile extends Component
{
    public User $student;

    public function mount(User $student): void
    {
        $this->student = $student;
    }

    public function render()
    {
        $this->student->load('currentGrade');

        $grades = Grade::with([
            'categories' => fn ($q) => $q->orderBy('order')
                ->with(['techniques' => fn ($q) => $q->orderBy('order')]),
        ])->orderBy('order')->get();

        $progressMap   = StudentProgress::where('user_id', $this->student->id)
            ->pluck('status', 'technique_id')->all();

        $totalCount    = $grades->sum(fn ($g) => $g->categories->sum(fn ($c) => $c->techniques->count()));
        $masteredCount = collect($progressMap)->filter(fn ($s) => $s === 'mastered')->count();
        $progressCount = collect($progressMap)->filter(fn ($s) => $s === 'progress')->count();

        $stageHistory = StageEnrollment::where('user_id', $this->student->id)
            ->where('status', 'accepted')
            ->with('stage')
            ->whereHas('stage', fn ($q) => $q->where('date', '<=', now()))
            ->get()
            ->sortByDesc(fn ($e) => $e->stage->date);

        $examHistory = ExamEnrollment::where('user_id', $this->student->id)
            ->with('exam.grade')
            ->whereHas('exam', fn ($q) => $q->where('date', '<=', now()))
            ->get()
            ->sortByDesc(fn ($e) => $e->exam->date);

        return view('livewire.admin.student-profile', [
            'student'       => $this->student,
            'totalCount'    => $totalCount,
            'masteredCount' => $masteredCount,
            'progressCount' => $progressCount,
            'stageHistory'  => $stageHistory,
            'examHistory'   => $examHistory,
        ])->layout('components.layouts.admin', ['title' => $this->student->name]);
    }
}
