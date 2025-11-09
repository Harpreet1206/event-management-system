<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Route::middleware(['auth', 'usertype:attendee'])->group(function () {
    //Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Other admin routes
//});

//Route::middleware(['auth', 'usertype:organizer'])->group(function () {
    //Route::get('/editor/panel', [EditorController::class, 'panel']);
    // Other editor routes
//});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('events', EventController::class);
    Route::post('events', [EventController::class, 'booking'])->name('events.booking');
});

require __DIR__.'/auth.php';
