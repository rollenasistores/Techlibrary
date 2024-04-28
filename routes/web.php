<?php

use App\Http\Controllers\BookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/admin/dashboard', function () {
    return Inertia::render('admin');
})->middleware('auth','verified','admin')
->name('admin.dashboard');

Route::resource('books', BookController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        if(Auth::user()->user_role == 1) {
            return redirect()->route('admin.dashboard');
        }else {
            return Inertia::render('Dashboard');
        }




    })->name('dashboard');
});
