<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/', [IndexController::class, 'addRecord'])->name('add_record');
Route::post('delete/{id}', [IndexController::class, 'deleteRecord']);
Route::post('deleteAll', [IndexController::class, 'deleteAllRecords'])->name('delete_all_records');
Route::get('/export', [IndexController::class, 'exportRecords'])->name('export_records');
Route::post('/update/{id}', [IndexController::class, 'updateRecord']);
