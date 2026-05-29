<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class Coaches extends Component
{
    public function render()
    {
        $coaches = User::where('role', 'admin')
            ->where('status', 'active')
            ->orderByDesc('is_owner')
            ->orderBy('name')
            ->get();

        return view('livewire.pages.coaches', compact('coaches'))
            ->layout('components.layouts.guest', ['title' => 'Antrenori']);
    }
        public function demoteCoach(int $id): void
    {
        // Nu permite retrogradarea owner-ului
        $coach = User::where('id', $id)->where('role', 'admin')->first();
        if ($coach && !$coach->is_owner) {
            $coach->update(['status' => 'inactive']);
        }
    }
}

