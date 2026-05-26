<?php

namespace App\Livewire\Auth;

use App\Mail\StudentPendingApproval;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Register extends Component
{
    public string $name     = '';
    public string $email    = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $registered = false;

    public function register(): void
    {
        $this->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $student = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => 'student',
            'status'   => 'pending',
        ]);

        $admins = User::where('role', 'admin')->where('status', 'active')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->queue(new StudentPendingApproval($student));
        }

        $this->registered = true;
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('components.layouts.guest', ['title' => 'Înregistrare']);
    }
}
