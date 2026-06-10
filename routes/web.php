<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::post('/events', [EventController::class, 'store'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/{id}', [EventController::class, 'update'])->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::post('/events/{id}/tickets', [TicketController::class, 'store'])->middleware('auth');
Route::get('/my-tickets', [TicketController::class, 'index'])->middleware('auth');
Route::get('/my-events', [EventController::class, 'myEvents'])->middleware('auth');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->middleware('auth');
Route::get('/events/{id}/buyers', [EventController::class, 'buyers'])->middleware('auth');
Route::get('/events/{eventId}/buyers/{ticketId}', [EventController::class, 'buyerDetails'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
