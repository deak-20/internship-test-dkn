<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TxtController;

// Default File
Route::get('/read', [TxtController::class, 'read'])->name('read');
Route::get('/edit', [TxtController::class, 'edit'])->name('edit');
Route::post('/update', [TxtController::class, 'update'])->name('update');
Route::get('/download-default', [TxtController::class, 'downloadDefault'])->name('downloadDefault');

// File Picker (View Only)
Route::get('/file-picker', [TxtController::class, 'filePicker'])->name('filePicker');
Route::post('/file-picker', [TxtController::class, 'filePickerRead'])->name('filePickerRead');

// Root
Route::get('/', fn() => redirect()->route('read'));
