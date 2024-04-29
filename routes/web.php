<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\photoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});


Route::get('storage/{filename}', [photoController::class, 'show'])->name('photo.show');



Route::get('/admin/dashboard', function () {
    return Inertia::render('admin/dashboard');
})->middleware('auth', 'verified', 'admin')
    ->name('admin.dashboard');

Route::resource('admin/books', BookController::class)->middleware('admin');
Route::resource('admin/genres', GenreController::class)->middleware('admin');
Route::resource('admin/authors', AuthorController::class)->middleware('admin');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        if (Auth::user()->user_role == 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return Inertia::render('Dashboard');
        }

    })->name('dashboard');
});
