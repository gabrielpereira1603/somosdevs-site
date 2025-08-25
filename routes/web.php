<?php

use App\Livewire\Pages\Welcome\Index as IndexWelcome;
use App\Livewire\Pages\BudgetOrQuestion\Index as IndexBudgetOrQuestion;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', IndexWelcome::class)->name('welcome');
Route::get('/budget', IndexBudgetOrQuestion::class)->name('budget');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
