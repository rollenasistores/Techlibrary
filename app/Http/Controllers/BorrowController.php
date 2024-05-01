<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Copy;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = Borrow::with('user', 'copy.book')->get()->where('user_role', 0)->where('is_confirmed', 0);

        return inertia('admin/borrows/index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $borrows = Borrow::with('user')->findOrFail($id);

        return inertia('admin/borrows/edit', compact('borrows'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $borrows = Borrow::find($id);

        if (!$borrows) {
            // Handle the case where the course is not found (e.g., return an error response)
            return response()->json(['error' => 'Code not found'], 404);
        }

        $request->validate([
            'code' => 'required',
        ]);

        if($borrows->code != $request->code) {

            session()->flash('error', 'Borrow Code doesn\'t match!');

            return redirect()->route('borrows.index')->with('error', session('error'));
        }


        $borrows->update(['confirmed' => 1,'returned_at' => now()]);

        $copy = Copy::find($borrows->copy_id);

        $copy->update(['is_available' => 1]);

        session()->flash('message', 'Borrow updated successfully!');

        return redirect()->route('borrows.index')->with('message', session('message'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $department = Borrow::find($id);
            $department->delete();

            session()->now('message', 'Successfully deleted a Borrow!');

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
