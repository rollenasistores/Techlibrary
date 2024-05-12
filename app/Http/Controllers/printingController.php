<?php

namespace App\Http\Controllers;

use App\Mail\PrintingEmail;
use App\Models\Printing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class printingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $printing = Printing::with('user')->get();

        return inertia('admin/printing/index', compact('printing'));
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
    public function show(Printing $printing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $printing = Printing::findOrFail($id);

        return inertia('admin/printing/edit', compact('printing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $printing = Printing::find($id);

        if (!$printing) {
            // Handle the case where the course is not found (e.g., return an error response)
            return response()->json(['error' => 'Printing not found'], 404);
        }

        $request->validate([
            'status' => 'required',
            'location' => 'required',
        ]);

        $printing->update(['status' => $request->status, ['location'=> $request->location]]);

        Mail::to($printing->user->email)->queue(new PrintingEmail($printing->user->name, $printing->file_name, $request->status));

        session()->flash('message', 'Printing Status updated successfully!');

        return redirect()->route('printing.index')->with('message', session('message'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Printing $printing)
    {
        //
    }

    public function userPrinting()
    {

        $printings = Printing::get()->where('user_id', auth()->user()->id);

        return inertia('user/services/index', compact('printings'));
    }

    public function userPrintingCreate()
    {
        return inertia('user/services/create');
    }

    public function userPrintingStore(Request $request)
    {
        $request->validate([
            'file_name' => 'required|mimes:pdf,doc,docx',
        ]);
    
        $originalFileName = $request->file('file_name')->getClientOriginalName(); // Get the original file name
        $extension = $request->file('file_name')->getClientOriginalExtension(); // Get the file extension
        $randomString = Str::random(10); // Generate a random string (you can adjust the length as needed)
    
        $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $randomString . '.' . $extension; // Append random string to file name
    
        $newPath = $request->file('file_name')->storeAs('public/files', $newFileName, 'local'); // Store with modified file name
    
        $printing = new Printing();
    
        $printing->user_id = auth()->user()->id;
        $printing->file_name = str_replace('public/', '', $newPath);
    
        $printing->save();
    
        session()->flash('message', 'Printing is on pending!');
    
        return redirect()->route('public.printing')->with('message', session('message'));
    }
    

}
