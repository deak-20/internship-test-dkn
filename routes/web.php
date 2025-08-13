<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TxtController;

// Data Default
Route::get('/read', [TxtController::class, 'read'])->name('read');
Route::get('/edit', [TxtController::class, 'edit'])->name('edit');
Route::post('/update', [TxtController::class, 'update'])->name('update');
Route::get('/download-default', [TxtController::class, 'downloadDefault'])->name('downloadDefault');

// File Picker
Route::get('/file-picker', [TxtController::class, 'filePicker'])->name('filePicker');
Route::post('/file-picker', [TxtController::class, 'filePickerRead'])->name('filePickerRead');
Route::post('/file-picker/update', [TxtController::class, 'filePickerUpdate'])->name('filePickerUpdate');
Route::get('/file-picker/download', [TxtController::class, 'filePickerDownload'])->name('filePickerDownload');

// Root
Route::get('/', function () {
    return redirect()->route('read');
});
