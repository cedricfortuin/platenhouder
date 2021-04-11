<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\Export\ExportController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/', [IndexController::class, 'addRecord'])->name('record.add');
Route::get('/export', [ExportController::class, 'exportRecords'])->name('record.export');
Route::post('/updateRecord/{id}', [IndexController::class, 'updateRecord'])->name("record.update");

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/registreren', [RegisterController::class, 'index'])->name('register')->middleware('auth');
Route::post('/registreren', [RegisterController::class, 'register'])->middleware('auth');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/update', [ConfigurationController::class, 'updatePagination'])->name('update_pagination');
