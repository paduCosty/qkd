<?php

namespace App\Livewire\Student;

use App\Models\Exam;
use App\Models\ExamEnrollment;
use App\Models\Grade;
use App\Models\Stage;
use App\Models\StageEnrollment;
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

    public function registerStage(int $stageId): void
    {
        $user  = auth()->user();
        $stage = Stage::findOrFail($stageId);

        if (! $stage->registrationOpen()) {
            return;
        }

        StageEnrollment::firstOrCreate(
            ['stage_id' => $stageId, 'user_id' => $user->id],
            ['status'   => 'pending']
        );
    }

    public function registerExam(int $examId): void
    {
        $user = auth()->user();

        $hadStage = StageEnrollment::where('user_id', $user->id)
            ->where('status', 'accepted')
            ->whereHas('stage', fn ($q) => $q->where('date', '>=', now()->subYear()))
            ->exists();

        ExamEnrollment::firstOrCreate(
            ['exam_id' => $examId, 'user_id' => $user->id],
            ['status' => 'pending', 'had_stage_last_year' => $hadStage]
        );
    }

    public function render()
    {
        $user = auth()->user()->load('currentGrade');

        $maxOrder = $user->currentGrade?->order ?? Grade::orderBy('order')->value('order') ?? 0;

        $grades = Grade::with([
            'categories' => fn ($q) => $q->orderBy('order')
                ->with(['techniques' => fn ($q) => $q->orderBy('order')]),
        ])->orderBy('order')->where('order', '<=', $maxOrder)->get();

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

        // Stages
        $upcomingStages = Stage::where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();

        $myStageEnrollments = StageEnrollment::where('user_id', $user->id)
            ->pluck('status', 'stage_id');

        $stageHistory = StageEnrollment::where('user_id', $user->id)
            ->where('status', 'accepted')
            ->with('stage')
            ->whereHas('stage', fn ($q) => $q->where('date', '<', now()->toDateString()))
            ->get()
            ->sortByDesc(fn ($e) => $e->stage->date);

        // Exams
        $upcomingExams = Exam::with('grade')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();

        $myExamEnrollments = ExamEnrollment::where('user_id', $user->id)
            ->pluck('status', 'exam_id');

        $examHistory = ExamEnrollment::where('user_id', $user->id)
            ->with('exam.grade')
            ->whereHas('exam', fn ($q) => $q->where('date', '<', now()->toDateString()))
            ->get()
            ->sortByDesc(fn ($e) => $e->exam->date);

        return view('livewire.student.dashboard', [
            'user'               => $user,
            'grades'             => $grades,
            'progressMap'        => $progressMap,
            'masteredCount'      => $masteredCount,
            'progressCount'      => $progressCount,
            'unknownCount'       => $unknownCount,
            'totalCount'         => $totalCount,
            'lastProgress'       => $lastProgress,
            'upcomingStages'     => $upcomingStages,
            'myStageEnrollments' => $myStageEnrollments,
            'stageHistory'       => $stageHistory,
            'upcomingExams'      => $upcomingExams,
            'myExamEnrollments'  => $myExamEnrollments,
            'examHistory'        => $examHistory,
        ])->layout('components.layouts.app', ['title' => 'Dashboard']);
    }
}
