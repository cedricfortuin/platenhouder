<?php

use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Music\MusicItemController;
use App\Http\Controllers\Water\WaterMeasurements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/record', MusicItemController::class)->only([
    'index', 'store', 'update', 'delete'
]);

Route::get('/calendar/events', [CalendarController::class, 'calendarEvents']);
Route::post('/calendar/update-event', [CalendarController::class, 'editCalendarEvent']);

//Route::prefix('/measurement')->group(function () {
//    Route::post('/store', [WaterMeasurements::class, 'store']);
//});
//Route::get('/measurements', [WaterMeasurements::class, 'index']);
