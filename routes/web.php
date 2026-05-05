<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NoteController;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Route::get('/dashboard', function () {
    //    return view('dashboard');
    //})->name('dashboard');
    Route::get('/dashboard',[NoteController::class, 'index'])->name('dashboard');
    Route::get('/note',[NoteController::class, 'add']);
    Route::post('/note',[NoteController::class, 'create']);
    
    Route::get('/note/{note}', [NoteController::class, 'edit']);
    Route::put('/note/{note}', [NoteController::class, 'update']);
    Route::delete('/note/{note}', [NoteController::class, 'destroy']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
