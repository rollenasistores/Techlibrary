<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::get();
        return inertia('admin/genres/index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('admin/genres/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Genre::create($request->all());

        session()->flash('message', 'Added new Genre!');

        return redirect()->route('genres.index')->with('message', session('message'));

    }
    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $genres = Genre::find($id);
        return inertia('admin/genres/edit', compact('genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $genres = Genre::find($id);

        if (!$genres) {
            // Handle the case where the course is not found (e.g., return an error response)
            return response()->json(['error' => 'Course not found'], 404);
        }

        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();
        $genres->fill($input)->update();

        session()->flash('message', 'Genre updated successfully!');

        return redirect()->route('genres.index')->with('message', session('message'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {

            $department = Genre::find($id);
            $department->delete();

            session()->now('message', 'Successfully Deleted a Genre!');

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
