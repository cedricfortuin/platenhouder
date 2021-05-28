<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Export\ExportController;
use App\Http\Controllers\Use\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/muziek', [PagesController::class, 'music'])->name('music');

Route::get('/export', [ExportController::class, 'exportRecords'])->name('record.export');

Route::get('/agenda', [CalendarController::class, 'index'])->name('calendar');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/registreren', [RegisterController::class, 'index'])->name('register')->middleware('auth');
Route::post('/registreren', [RegisterController::class, 'register'])->middleware('auth');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
