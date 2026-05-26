<?php

namespace App\Livewire\Auth;

use App\Models\AdminInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterViaInvite extends Component
{
    public string $token = '';
    public ?AdminInvitation $invitation = null;

    public string $name     = '';
    public string $email    = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $invalid = false;

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->invitation = AdminInvitation::where('token', $token)->first();

        if (! $this->invitation || ! $this->invitation->isValid()) {
            $this->invalid = true;
        }
    }

    public function register(): void
    {
        if ($this->invalid) return;

        $this->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Re-check invitation validity
        $this->invitation->refresh();
        if (! $this->invitation->isValid()) {
            $this->invalid = true;
            return;
        }

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => 'admin',
            'status'   => 'active',
            'is_owner' => false,
        ]);

        $this->invitation->update([
            'used_at' => now(),
            'used_by' => $user->id,
        ]);

        Auth::login($user);
        $this->redirect(route('admin.dashboard'), navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.register-via-invite')
            ->layout('components.layouts.guest', ['title' => 'Înregistrare antrenor']);
    }
}
