<?php

namespace App\Livewire\Admin;

use App\Models\Exam;
use App\Models\ExamEnrollment;
use App\Models\Grade;
use Livewire\Component;

class Exams extends Component
{
    public string $view = 'list';
    public ?int $editExamId = null;
    public ?int $viewExamId = null;

    public string $title    = '';
    public string $date     = '';
    public string $location = '';
    public string $notes    = '';

    public function openCreate(): void
    {
        $this->reset(['title', 'date', 'location', 'notes', 'editExamId']);
        $this->view = 'form';
    }

    public function openEdit(int $id): void
    {
        $e = Exam::findOrFail($id);
        $this->editExamId = $id;
        $this->title      = $e->title;
        $this->date       = $e->date->format('Y-m-d');
        $this->location   = $e->location ?? '';
        $this->notes      = $e->notes ?? '';
        $this->view = 'form';
    }

    public function saveExam(): void
    {
        $this->validate([
            'title'    => ['required', 'string', 'max:150'],
            'date'     => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:150'],
            'notes'    => ['nullable', 'string'],
        ]);

        $data = [
            'title'      => $this->title,
            'date'       => $this->date,
            'location'   => $this->location ?: null,
            'notes'      => $this->notes ?: null,
            'created_by' => auth()->id(),
        ];

        if ($this->editExamId) {
            Exam::findOrFail($this->editExamId)->update($data);
        } else {
            Exam::create($data);
        }

        $this->view = 'list';
    }

    public function cancelForm(): void
    {
        $this->view = 'list';
    }

    public function deleteExam(int $id): void
    {
        Exam::findOrFail($id)->delete();
    }

    public function openRegistrations(int $id): void
    {
        $this->viewExamId = $id;
        $this->view = 'registrations';
    }

    public function backToList(): void
    {
        $this->viewExamId = null;
        $this->view = 'list';
    }

    public function accept(int $enrollmentId): void
    {
        ExamEnrollment::findOrFail($enrollmentId)->update(['status' => 'accepted']);
    }

    public function reject(int $enrollmentId): void
    {
        ExamEnrollment::findOrFail($enrollmentId)->update(['status' => 'rejected']);
    }

    public function markResult(int $enrollmentId, string $result): void
    {
        $enrollment = ExamEnrollment::with(['user.currentGrade', 'exam'])->findOrFail($enrollmentId);
        $enrollment->update(['result' => $result]);

        if ($result === 'passed') {
            $user         = $enrollment->user;
            $currentOrder = $user->currentGrade?->order ?? 0;
            $nextGrade    = Grade::where('order', '>', $currentOrder)->orderBy('order')->first();
            if ($nextGrade) {
                $user->update(['current_grade_id' => $nextGrade->id]);
            }
        }
    }

    public function render()
    {
        $upcoming = Exam::withCount('enrollments')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();

        $past = Exam::withCount('enrollments')
            ->where('date', '<', now()->toDateString())
            ->orderByDesc('date')
            ->get();

        $exam          = null;
        $registrations = null;

        if ($this->view === 'registrations' && $this->viewExamId) {
            $exam          = Exam::findOrFail($this->viewExamId);
            $registrations = ExamEnrollment::where('exam_id', $this->viewExamId)
                ->with(['user.currentGrade'])
                ->orderBy('created_at')
                ->get();
        }

        return view('livewire.admin.exams', compact('upcoming', 'past', 'exam', 'registrations'))
            ->layout('components.layouts.admin', ['title' => 'Examene']);
    }
}
