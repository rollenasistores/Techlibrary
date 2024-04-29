<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        return inertia('admin/authors/index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('admin/authors/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:authors',
        ]);

        Author::create($request->all());

        session()->flash('message', 'Added new Author!');

        return redirect()->route('authors.index')->with('message', session('message'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $authors = Author::find($id);
        
        return inertia('admin/authors/edit', compact('authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $authors = Author::find($id);

        if (!$authors) {
            // Handle the case where the course is not found (e.g., return an error response)
            return response()->json(['error' => 'Author not found'], 404);
        }

        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();
        $authors->fill($input)->update();

        session()->flash('message', 'Author updated successfully!');

        return redirect()->route('authors.index')->with('message', session('message'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {

            $author = Author::find($id);
            $author->delete();

            session()->now('message', 'Successfully deleted a Author!');

            Inertia::share('flash', function () {
                return [
                    'message' => session('message'),
                ];
            });

            return redirect()->route('authors.index')->with('message', session('message'));

        } catch (QueryException $e) {

            session()->flash('error', 'Unable to delete this record. It is associated with other data in the system. Please make sure there are no dependencies before attempting to delete.');

            return redirect()->route('authors.index')->with('error', session('error'));

        }
    }
}
