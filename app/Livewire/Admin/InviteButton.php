<?php

namespace App\Livewire\Admin;

use App\Models\AdminInvitation;
use Illuminate\Support\Str;
use Livewire\Component;

class InviteButton extends Component
{
    public ?string $link = null;

    public function generate(): void
    {
        $token = Str::random(48);

        AdminInvitation::create([
            'token'      => $token,
            'created_by' => auth()->id(),
            'expires_at' => now()->addHours(48),
        ]);

        $this->link = route('invite', ['token' => $token]);
    }

    public function render()
    {
        return view('livewire.admin.invite-button');
    }
}
