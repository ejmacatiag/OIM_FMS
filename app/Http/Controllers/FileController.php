<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{

    public function dashboard()
    {
        $totalFiles = File::count();
        return view('dashboard', compact('totalFiles'));
    }
    
    // public function index()
    // {

    //      // Fetch all files without filtering by user
    //     $files = File::all();
    //     return view('files.index', compact('files'));
        
    // }

    public function index()
    {
        // Fetch all files ordered by date_received in descending order (latest first)
        $files = File::orderBy('date_received', 'desc')->get();
        return view('files.index', compact('files'));
    }
    public function office(Request $request)
    {
        $unit = $request->query('unit');
    
        // These are all the known offices shown in the dashboard
        $knownOffices = [
            'admin', 'cashiering', 'finance', 'property',
            'planning', 'design', 'construction', 'idu',
            'equipment', 'survey', 'srip',
            'asris', 'sfdris', 'laris', 'adris',
            'regional'
        ];
    
        $files = File::with('user')
            ->when($unit === 'agencies', function ($query) use ($knownOffices) {
                // Show all files NOT from any known dashboard office
                $query->whereNotIn('office', $knownOffices);
            })
            ->when($unit !== 'agencies' && $unit !== null, function ($query) use ($unit) {
                // Show files matching the unit
                $query->where('office', $unit);
            })
            ->get();
    
        return view('files.office', compact('files', 'unit'));
    }
    
    


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:25600',
            'title_communication' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
            'date_received' => 'required|date',
        ]);
    
        $file = $request->file('file');
        $filePath = $file->store('uploads', 'public');
    
        File::create([
            'user_id' => Auth::id(),
            'name' => $file->getClientOriginalName(),
            'path' => $filePath,
            'title_communication' => $request->title_communication,
            'office' => $request->office,
            'remarks' => $request->remarks,
            'date_received' => $request->date_received,
        ]);
    
        return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
    }
    
    
    public function download($id)
    {
        // Retrieve the file from the database
        $file = File::findOrFail($id); // Remove the user check here
    
        // Use Storage::disk('public') without the 'public/' prefix
        return Storage::disk('public')->download($file->path, $file->name);
    }

    public function destroy($id)
    {
        // Find the file record by ID
        $file = File::findOrFail($id);
    
        // No need to check if the file belongs to the authenticated user anymore
        // if ($file->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized access.');
        // }
    
        // Delete the file from storage (uploads folder)
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }
    
        // Delete the file record from the database
        $file->delete();
    
        // Redirect back with success message
        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
    

    public function update(Request $request, File $file)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title_communication' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'date_received' => 'required|date', // Add date validation
        ]);

        // Update the file details
        $file->title_communication = $validated['title_communication'];
        $file->office = $validated['office'];
        $file->remarks = $validated['remarks'];
        $file->date_received = $validated['date_received'];  // Update date_received field
        $file->save();

        // Return a JSON response
        return response()->json(['success' => 'File details updated successfully']);
    }

        
}
