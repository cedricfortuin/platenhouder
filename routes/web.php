<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/', [IndexController::class, 'addRecord'])->name('add_record');
Route::post('delete/{id}', [IndexController::class, 'deleteRecord']);
Route::post('deleteAll', [IndexController::class, 'deleteAllRecords'])->name('delete_all_records');
Route::get('/export', [IndexController::class, 'exportRecords'])->name('export_records');
Route::post('/update/{id}', [IndexController::class, 'updateRecord']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/registreren', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/registreren', [RegisterController::class, 'register']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/update', [ConfigurationController::class, 'updatePagination'])->name('update_pagination');
