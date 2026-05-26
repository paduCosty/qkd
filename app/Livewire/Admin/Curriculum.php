<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Technique;
use Livewire\Component;
use Livewire\WithFileUploads;

class Curriculum extends Component
{
    use WithFileUploads;

    // Category edit
    public ?int   $editCatId       = null;
    public string $editCatNameViet = '';
    public string $editCatNameRo   = '';

    // Category add
    public ?int   $addCatGradeId  = null;
    public string $newCatNameViet = '';
    public string $newCatNameRo   = '';

    // Technique inline edit
    public ?int    $editTechId       = null;
    public string  $editTechNameViet = '';
    public string  $editTechNameRo   = '';
    public string  $editTechType     = 'simple';
    public string  $editTechDesc     = '';
    public string  $editTechVideo    = '';
    public string  $editTechNote     = '';
    public string  $editVideoTab     = 'url';
    public mixed   $editTechFile     = null;

    // Add technique
    public ?int   $addTechCatId    = null;
    public string $techNameViet    = '';
    public string $techNameRo      = '';
    public string $techType        = 'simple';
    public string $techDescription = '';
    public string $techVideoUrl    = '';
    public string $techCoachNote   = '';
    public string $addVideoTab     = 'url';
    public mixed  $techVideoFile   = null;

    // ── Categories ──────────────────────────────────────────────────────────

    public function openAddCategory(int $gradeId): void
    {
        $this->addCatGradeId  = $gradeId;
        $this->newCatNameViet = '';
        $this->newCatNameRo   = '';
        $this->editCatId      = null;
        $this->editTechId     = null;
        $this->addTechCatId   = null;
    }

    public function addCategory(): void
    {
        $this->validate([
            'newCatNameViet' => ['required', 'string', 'max:100'],
            'newCatNameRo'   => ['required', 'string', 'max:150'],
        ]);

        $maxOrder = Category::where('grade_id', $this->addCatGradeId)->max('order') ?? -1;

        Category::create([
            'grade_id'  => $this->addCatGradeId,
            'name_viet' => strtoupper($this->newCatNameViet),
            'name_ro'   => $this->newCatNameRo,
            'order'     => $maxOrder + 1,
        ]);

        $this->addCatGradeId = null;
    }

    public function startEditCategory(int $id): void
    {
        $cat = Category::findOrFail($id);
        $this->editCatId       = $id;
        $this->editCatNameViet = $cat->name_viet;
        $this->editCatNameRo   = $cat->name_ro;
        $this->editTechId      = null;
        $this->addTechCatId    = null;
        $this->addCatGradeId   = null;
    }

    public function saveCategory(): void
    {
        $this->validate([
            'editCatNameViet' => ['required', 'string', 'max:100'],
            'editCatNameRo'   => ['required', 'string', 'max:150'],
        ]);

        Category::findOrFail($this->editCatId)->update([
            'name_viet' => strtoupper($this->editCatNameViet),
            'name_ro'   => $this->editCatNameRo,
        ]);

        $this->editCatId = null;
    }

    public function deleteCategory(int $id): void
    {
        Category::findOrFail($id)->delete();
    }

    // ── Techniques ──────────────────────────────────────────────────────────

    public function openAddTechnique(int $categoryId): void
    {
        $this->addTechCatId    = $categoryId;
        $this->techNameViet    = '';
        $this->techNameRo      = '';
        $this->techType        = 'simple';
        $this->techDescription = '';
        $this->techVideoUrl    = '';
        $this->techCoachNote   = '';
        $this->addVideoTab     = 'url';
        $this->techVideoFile   = null;
        $this->editTechId      = null;
        $this->editCatId       = null;
        $this->addCatGradeId   = null;
    }

    public function addTechnique(): void
    {
        $rules = [
            'techNameViet' => ['required', 'string', 'max:100'],
            'techNameRo'   => ['required', 'string', 'max:200'],
            'techType'     => ['required', 'in:simple,form'],
        ];

        if ($this->addVideoTab === 'upload' && $this->techVideoFile) {
            $rules['techVideoFile'] = ['file', 'mimes:mp4,webm,mov', 'max:204800'];
        }

        $this->validate($rules);

        $videoUrl = null;

        if ($this->addVideoTab === 'upload' && $this->techVideoFile) {
            $path = $this->techVideoFile->store('videos', 'public');
            $videoUrl = 'storage/' . $path;
        } elseif ($this->addVideoTab === 'url' && $this->techVideoUrl) {
            $videoUrl = $this->techVideoUrl;
        }

        $maxOrder = Technique::where('category_id', $this->addTechCatId)->max('order') ?? -1;

        Technique::create([
            'category_id' => $this->addTechCatId,
            'name_viet'   => strtoupper($this->techNameViet),
            'name_ro'     => $this->techNameRo,
            'type'        => $this->techType,
            'description' => $this->techDescription ?: null,
            'video_url'   => $videoUrl,
            'coach_note'  => $this->techCoachNote ?: null,
            'order'       => $maxOrder + 1,
        ]);

        $this->addTechCatId = null;
    }

    public function startEditTechnique(int $id): void
    {
        $tech = Technique::findOrFail($id);
        $this->editTechId       = $id;
        $this->editTechNameViet = $tech->name_viet;
        $this->editTechNameRo   = $tech->name_ro;
        $this->editTechType     = $tech->type;
        $this->editTechDesc     = $tech->description ?? '';
        $this->editTechNote     = $tech->coach_note ?? '';
        $this->editTechFile     = null;

        if ($tech->video_url && ! $tech->youtubeEmbedUrl()) {
            $this->editVideoTab  = 'upload';
            $this->editTechVideo = $tech->video_url;
        } else {
            $this->editVideoTab  = 'url';
            $this->editTechVideo = $tech->video_url ?? '';
        }

        $this->addTechCatId  = null;
        $this->editCatId     = null;
        $this->addCatGradeId = null;
    }

    public function saveTechnique(): void
    {
        $rules = [
            'editTechNameViet' => ['required', 'string', 'max:100'],
            'editTechNameRo'   => ['required', 'string', 'max:200'],
            'editTechType'     => ['required', 'in:simple,form'],
        ];

        if ($this->editVideoTab === 'upload' && $this->editTechFile) {
            $rules['editTechFile'] = ['file', 'mimes:mp4,webm,mov', 'max:204800'];
        }

        $this->validate($rules);

        $tech = Technique::findOrFail($this->editTechId);

        $videoUrl = $tech->video_url;

        if ($this->editVideoTab === 'upload' && $this->editTechFile) {
            if ($tech->video_url && ! $tech->youtubeEmbedUrl()) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $tech->video_url));
            }
            $path = $this->editTechFile->store('videos', 'public');
            $videoUrl = 'storage/' . $path;
        } elseif ($this->editVideoTab === 'url') {
            $videoUrl = $this->editTechVideo ?: null;
        }

        $tech->update([
            'name_viet'   => strtoupper($this->editTechNameViet),
            'name_ro'     => $this->editTechNameRo,
            'type'        => $this->editTechType,
            'description' => $this->editTechDesc ?: null,
            'video_url'   => $videoUrl,
            'coach_note'  => $this->editTechNote ?: null,
        ]);

        $this->editTechId = null;
    }

    public function deleteTechnique(int $id): void
    {
        $tech = Technique::findOrFail($id);

        if ($tech->video_url && ! $tech->youtubeEmbedUrl()) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $tech->video_url));
        }

        $tech->delete();
    }

    public function render()
    {
        $grades = Grade::orderBy('order')
            ->with(['categories' => fn ($q) => $q->orderBy('order')
                ->with(['techniques' => fn ($q) => $q->orderBy('order')])])
            ->get();

        return view('livewire.admin.curriculum', [
            'grades' => $grades,
        ])->layout('components.layouts.admin', ['title' => 'Programă']);
    }
}
