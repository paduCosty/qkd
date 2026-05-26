<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Offline fallback (served by service worker)
Route::get('/offline', fn () => response()->file(public_path('offline.html')))->name('offline');

// Home
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return redirect()->route($user->isAdmin() ? 'admin.dashboard' : 'student.dashboard');
    }
    return view('home');
})->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login',    App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', App\Livewire\Auth\Register::class)->name('register');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');

// Student area
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', App\Livewire\Student\Dashboard::class)->name('student.dashboard');
});

// Admin area
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',        App\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('/curriculum',       App\Livewire\Admin\Curriculum::class)->name('curriculum');
    Route::get('/grades/{grade}',   App\Livewire\Admin\ManageGrade::class)->name('grades.manage');
});
