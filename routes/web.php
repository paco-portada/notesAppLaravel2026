<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NoteController;

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