<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\printingController;
use App\Mail\ReturnBookEmail;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Printing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('list-of-books', function () {
    $books = Book::with('author', 'genre', 'copies')->get();
    return Inertia::render('Books', compact('books'));
})->name('list-of-books');

Route::get('about', function () {
    return Inertia::render('About');
})->name('aboutus');

Route::get('services', function () {
    return Inertia::render('Services');
})->name('services');

Route::get('storage/{filename}', )->name('photo.show');

Route::get('/books', function () {
    $books = Book::with('author', 'genre', 'copies')->get();
    return Inertia::render('user/books/index', compact('books'));
})->middleware('auth', 'verified')
    ->name('books');

Route::get('/books/borrowed', [BookController::class, 'userBorrowedBook'])
    ->middleware('auth', 'verified')
    ->name('public.books.borrowed');

Route::get('/books/{id}', [BookController::class, 'showBook'])
    ->middleware('auth', 'verified')
    ->name('public.books.show');

Route::get('/books/borrow/{id}', [BookController::class, 'borrowBook'])
    ->middleware('auth', 'verified')
    ->name('public.books.borrow');

Route::post('public/books/borrow/store', [BookController::class, 'borrowBookStore'])->name('public.books.borrow.store');

Route::post('public/contact', [ContactController::class, 'store'])->name('public.contact');



Route::get('/printing/services', [printingController::class, 'userPrinting'])
    ->middleware('auth', 'verified')
    ->name('public.printing');

Route::get('/printing/create', [printingController::class, 'userPrintingCreate'])
    ->middleware('auth', 'verified')
    ->name('public.printing.create');

    Route::post('/printing/store', [printingController::class, 'userPrintingStore'])
    ->middleware('auth', 'verified')
    ->name('public.printing.store');
    


Route::get('/admin/dashboard', function () {

    $users = User::get()->where('user_role', 0)->count();
    $borrowedBooks = Borrow::get()->count();
    $books = Book::get()->count();
    $printings = Printing::get()->count();
    
    return Inertia::render('admin/dashboard', compact('users', 'borrowedBooks', 'books', 'printings'));
})->middleware('auth', 'verified', 'admin')
    ->name('admin.dashboard');

Route::resource('admin/books', BookController::class)->middleware('admin');
Route::resource('admin/genres', GenreController::class)->middleware('admin');
Route::resource('admin/authors', AuthorController::class)->middleware('admin');
Route::resource('admin/borrows', BorrowController::class)->middleware('admin');
Route::resource('admin/printing', printingController::class)->middleware('admin');

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
