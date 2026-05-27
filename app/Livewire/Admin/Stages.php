<?php

namespace App\Livewire\Admin;

use App\Models\Stage;
use App\Models\StageEnrollment;
use Livewire\Component;

class Stages extends Component
{
    public string $view = 'list';
    public ?int $editStageId   = null;
    public ?int $viewStageId   = null;

    public string $title                = '';
    public string $date                 = '';
    public string $location             = '';
    public string $description          = '';
    public string $registrationDeadline = '';

    public function openCreate(): void
    {
        $this->reset(['title', 'date', 'location', 'description', 'registrationDeadline', 'editStageId']);
        $this->view = 'form';
    }

    public function openEdit(int $id): void
    {
        $s = Stage::findOrFail($id);
        $this->editStageId          = $id;
        $this->title                = $s->title;
        $this->date                 = $s->date->format('Y-m-d');
        $this->location             = $s->location ?? '';
        $this->description          = $s->description ?? '';
        $this->registrationDeadline = $s->registration_deadline?->format('Y-m-d') ?? '';
        $this->view = 'form';
    }

    public function saveStage(): void
    {
        $this->validate([
            'title'                => ['required', 'string', 'max:150'],
            'date'                 => ['required', 'date'],
            'location'             => ['nullable', 'string', 'max:150'],
            'description'          => ['nullable', 'string'],
            'registrationDeadline' => ['nullable', 'date'],
        ]);

        $data = [
            'title'                 => $this->title,
            'date'                  => $this->date,
            'location'              => $this->location ?: null,
            'description'           => $this->description ?: null,
            'registration_deadline' => $this->registrationDeadline ?: null,
            'created_by'            => auth()->id(),
        ];

        if ($this->editStageId) {
            Stage::findOrFail($this->editStageId)->update($data);
        } else {
            Stage::create($data);
        }

        $this->view = 'list';
    }

    public function cancelForm(): void
    {
        $this->view = 'list';
    }

    public function deleteStage(int $id): void
    {
        Stage::findOrFail($id)->delete();
    }

    public function openParticipants(int $id): void
    {
        $this->viewStageId = $id;
        $this->view = 'participants';
    }

    public function backToList(): void
    {
        $this->viewStageId = null;
        $this->view = 'list';
    }

    public function accept(int $enrollmentId): void
    {
        StageEnrollment::findOrFail($enrollmentId)->update(['status' => 'accepted']);
    }

    public function reject(int $enrollmentId): void
    {
        StageEnrollment::findOrFail($enrollmentId)->update(['status' => 'rejected']);
    }

    public function render()
    {
        $upcoming = Stage::withCount('enrollments')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();

        $past = Stage::withCount('enrollments')
            ->where('date', '<', now()->toDateString())
            ->orderByDesc('date')
            ->get();

        $stage        = null;
        $participants = null;

        if ($this->view === 'participants' && $this->viewStageId) {
            $stage = Stage::findOrFail($this->viewStageId);
            $participants = StageEnrollment::where('stage_id', $this->viewStageId)
                ->with(['user.currentGrade'])
                ->orderBy('created_at')
                ->get();
        }

        return view('livewire.admin.stages', compact('upcoming', 'past', 'stage', 'participants'))
            ->layout('components.layouts.admin', ['title' => 'Stagii']);
    }
}
