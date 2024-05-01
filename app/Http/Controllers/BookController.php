<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Copy;
use App\Models\Genre;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author', 'genre', 'copies')->get();

        return inertia('admin/books/index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::get()->select('id', 'name');
        $genres = Genre::get();
        return inertia('admin/books/create', compact('authors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
            'genre_id' => 'required',
            'image_url' => 'required|file|image',
            'description' => 'required',
            'publication_year' => 'required',
            'quantity' => 'required',
        ]);

        // ...or just move it somewhere else (eg: local `storage` directory or S3)
        $newPath = $request['image_url']->store('public/images', 'local');

        $book = new Book();

        // Set the attributes
        $book->name = $request->name;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->description = $request->description;
        $book->publication_year = $request->publication_year;
        $book->quantity = $request->quantity;
        $book->image_url = str_replace('public/', '', $newPath);

        // Save the book
        $book->save();

        session()->flash('message', 'Added new Book!');

        return redirect()->route('books.index')->with('message', session('message'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $books = Book::find($id);
        $authors = Author::get()->select('id', 'name');
        $genres = Genre::get();
        return inertia('admin/books/edit', compact('books', 'authors', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $genres = Book::find($id);

        if (!$genres) {
            // Handle the case where the course is not found (e.g., return an error response)
            return response()->json(['error' => 'Book not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
            'genre_id' => 'required',
            'publication_year' => 'required',
            'quantity' => 'required',
        ]);

        $input = $request->all();
        $genres->fill($input)->update();

        session()->flash('message', 'Book updated successfully!');

        return redirect()->route('books.index')->with('message', session('message'));
    }

    /**
     *
     *
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy($id)
    {

        try {
            $book = Book::find($id);
            $book->delete();

            session()->now('message', 'Successfully deleted a book!');

            Inertia::share('flash', function () {
                return [
                    'message' => session('message'),
                ];
            });

            return redirect()->route('genres.index')->with('message', session('message'));

        } catch (QueryException $e) {

            session()->flash('error', 'Unable to delete this record. It is associated with other data in the system. Please make sure there are no dependencies before attempting to delete.');

            return redirect()->route('genres.index')->with('error', session('error'));

        }
    }

    /**
     *
     *
     * User Function wherein they'll be able to get a specific book they want to see
     *
     *
     */

    public function showBook($id)
    {
        $books = Book::with('author', 'genre', 'copies')->find($id);

        $booksOfAuthor = Book::get()->where('author_id', $books->author_id)->whereNotIn('id', $id);

        return inertia('user/books/show', compact('books', 'booksOfAuthor'));
    }

    public function borrowBook($id)
    {
        $books = Book::with('copies')->find($id);

        return inertia('user/books/borrow', compact('books'));

    }

    public function borrowBookStore(Request $request)
    {
        $request->validate([
            'borrowed_at' => 'required|date',
            'returned_at' => 'required|date|after_or_equal:borrowed_at|before_or_equal:' . now()->addWeek()->format('Y-m-d'),
        ], [
            'returned_at.before_or_equal' => 'The return date must be within one week from the borrowing date.',
        ]);

        // Check if the user has already borrowed the same book
        $existingBorrow = Borrow::where('user_id', auth()->user()->id)
            ->where('copy_id', $request->copy_id)
            ->where('confirmed', 0)
            ->exists();

        if ($existingBorrow) {

            session()->flash('error', 'You have already borrowed this book.');

            return redirect()->route('books')->with('error', session('error'));

        }

        $code = Str::random(8); // Generates a random string of 8 characters

        $borrow = new Borrow();

        // Set the attributes
        $borrow->user_id = $request->user_id;
        $borrow->borrowed_at = $request->borrowed_at;
        $borrow->returned_at = $request->returned_at;
        $borrow->copy_id = $request->copy_id;
        $borrow->code = $code;

        // Save the book
        $borrow->save();

        $copy = Copy::find($request->copy_id);

        $copy->update(['is_available' => 0]);

        session()->flash('message', 'Added new Book!');

        return redirect()->route('books')->with('message', session('message'));


    }

    public function userBorrowedBook()
    {

        $books = Borrow::with('copy', 'copy.book')->where('user_id', auth()->user()->id)->get();

        return inertia('user/books/borrowed', compact('books'));
    }
}
