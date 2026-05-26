<?php

namespace App\Livewire\Admin;

use App\Models\Grade;
use App\Models\Technique;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    // Grade form
    public bool   $showAddGrade  = false;
    public string $newGradeName  = '';
    public int    $newGradeOrder = 0;

    // Grade inline edit
    public ?int   $editGradeId   = null;
    public string $editGradeName = '';
    public int    $editGradeOrder = 0;

    public function approveStudent(int $id): void
    {
        User::where('id', $id)->where('role', 'student')->update(['status' => 'active']);
    }

    public function rejectStudent(int $id): void
    {
        User::where('id', $id)->where('role', 'student')->update(['status' => 'rejected']);
    }

    public function setStudentGrade(int $userId, $gradeId): void
    {
        User::where('id', $userId)->update(['current_grade_id' => $gradeId ?: null]);
    }

    public function addGrade(): void
    {
        $this->validate([
            'newGradeName'  => ['required', 'string', 'max:100'],
            'newGradeOrder' => ['required', 'integer', 'min:0'],
        ]);

        Grade::create(['name' => $this->newGradeName, 'order' => $this->newGradeOrder]);

        $this->newGradeName  = '';
        $this->newGradeOrder = 0;
        $this->showAddGrade  = false;
    }

    public function startEditGrade(int $id): void
    {
        $grade               = Grade::findOrFail($id);
        $this->editGradeId   = $id;
        $this->editGradeName = $grade->name;
        $this->editGradeOrder = $grade->order;
    }

    public function saveGrade(): void
    {
        $this->validate([
            'editGradeName'  => ['required', 'string', 'max:100'],
            'editGradeOrder' => ['required', 'integer', 'min:0'],
        ]);

        Grade::findOrFail($this->editGradeId)->update([
            'name'  => $this->editGradeName,
            'order' => $this->editGradeOrder,
        ]);

        $this->editGradeId = null;
    }

    public function cancelEditGrade(): void
    {
        $this->editGradeId = null;
    }

    public function deleteGrade(int $id): void
    {
        Grade::findOrFail($id)->delete();
    }

    public function render()
    {
        $pendingStudents = User::where('role', 'student')->where('status', 'pending')
            ->orderBy('created_at')->get();

        $activeStudents = User::where('role', 'student')->where('status', 'active')
            ->with('currentGrade')->orderBy('name')->get();

        $grades = Grade::withCount(['categories', 'categories as techniques_count' => fn ($q) => $q->withCount('techniques')])
            ->with([
                'categories' => fn ($q) => $q->withCount('techniques')->orderBy('order'),
            ])
            ->orderBy('order')
            ->get();

        $allGrades = Grade::orderBy('order')->get();

        return view('livewire.admin.dashboard', [
            'pendingStudents' => $pendingStudents,
            'activeStudents'  => $activeStudents,
            'grades'          => $grades,
            'allGrades'       => $allGrades,
            'stats'           => [
                'activeCount'    => $activeStudents->count(),
                'pendingCount'   => $pendingStudents->count(),
                'techniqueCount' => Technique::count(),
                'gradeCount'     => $grades->count(),
            ],
        ])->layout('components.layouts.admin', ['title' => 'Dashboard']);
    }
}
