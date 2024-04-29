<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author','genre','copies')->get();
        
        return inertia('admin/books/index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::get()->select('id','name');
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
            'publication_year' => 'required',
            'quantity' => 'required',
        ]);

        Book::create($request->all());

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
        $authors = Author::get()->select('id','name');
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
     * Remove the specified resource from storage.
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
}
