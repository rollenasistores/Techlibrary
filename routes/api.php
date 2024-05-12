<?php

use App\Http\Controllers\LibraryStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/library-status', [LibraryStatusController::class, 'show']);
Route::put('/library-status', [LibraryStatusController::class, 'update']);
