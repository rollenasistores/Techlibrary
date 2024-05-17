<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_role', 0)->get();

        return inertia('admin/users/index', compact('users'));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return inertia('admin/users/edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $department = User::find($id);
            $department->delete();

            session()->now('message', 'Successfully deleted a User!');

            Inertia::share('flash', function () {
                return [
                    'message' => session('message'),
                ];
            });

            return redirect()->route('users.index')->with('message', session('message'));

        } catch (QueryException $e) {

            session()->flash('error', 'Unable to delete this record. It is associated with other data in the system. Please make sure there are no dependencies before attempting to delete.');

            return redirect()->route('users.index')->with('error', session('error'));

        }
    }
}
