<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public string $email    = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'email' => 'Email sau parolă incorectă.',
            ]);
        }

        $user = Auth::user();

        if ($user->isStudent() && $user->isPending()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Contul tău așteaptă aprobarea antrenorului.',
            ]);
        }

        if ($user->isStudent() && $user->status === 'rejected') {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Cererea ta de înregistrare a fost respinsă.',
            ]);
        }

        session()->regenerate();

        $this->redirect(
            $user->isAdmin() ? route('admin.dashboard') : route('student.dashboard'),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.guest', ['title' => 'Autentificare']);
    }
}
