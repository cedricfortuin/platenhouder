<?php

use App\Http\Controllers\Music\MusicItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/music', [MusicItemController::class, 'index']);
Route::prefix('/record')->group(function(){
   Route::post('/store', [MusicItemController::class, 'store']);
   Route::put('/{id}', [MusicItemController::class, 'update']);
   Route::delete('/{id}', [MusicItemController::class, 'destroy']);
});
