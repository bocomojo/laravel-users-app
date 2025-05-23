<?php

namespace App\Http\Controllers;

use App\Models\Sdo;
use Illuminate\Http\Request;

class SdoController extends Controller
{
    // Show all SDO records with optional search functionality
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the SDO records, applying search filters if a search query is provided
        $sdoRecords = Sdo::when($search, function ($query) use ($search) {
            // Filter records where name, email, or contact_number matches the search query
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%')
                         ->orWhere('contact_number', 'like', '%' . $search . '%');
        })
        ->paginate(10);  // Paginate results (10 records per page)

        // Return the view with the SDO records and the search query for displaying in the search form
        return view('sdo.index', compact('sdoRecords', 'search'));
    }

    // Show the form to create a new SDO record
    public function create()
    {
        // Return the view for creating a new SDO record
        return view('sdo.create');
    }

    // Store a new SDO record in the database
    public function store(Request $request)
    {
        // Validate the incoming request to ensure the data is correct
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sdo,email',
            'contact_number' => 'required|string|max:20',
        ]);
    
        try {
            // Create a new SDO record in the database
            Sdo::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
            ]);
    
            // Redirect to the index page with a success message
            return redirect()->route('sdo.index')->with('success', 'SDO record created successfully!');
        } catch (\Exception $e) {
            // Redirect to the index page with an error message in case of failure
            return redirect()->route('sdo.index')->with('error', 'An error occurred. Please try again later.');
        }
    }    

    // Show the form to edit an existing SDO record
    public function edit($id)
    {
        // Find the record by ID, or fail if not found
        $record = Sdo::findOrFail($id);
        
        // Return the edit view with the record to be edited
        return view('sdo.edit', compact('record'));
    }

    // Update an existing SDO record
    public function update(Request $request, $id)
    {
        // Validate the incoming request to ensure the data is correct
        $request->validate([
            'name' => 'required|string|max:255', // Name is required, should be a string, and has a max length of 255 characters
            'email' => 'required|email|unique:sdo,email,' . $id, // Email is required, should be unique except for the current record
            'contact_number' => 'required|string|max:20', // Contact number is required, should be a string with a max length of 20 characters
        ]);

        // Find the existing record by ID
        $record = Sdo::findOrFail($id);
        
        // Update the record with the new data
        $record->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
        ]);

        // Redirect to the SDO records index page with a success message
        return redirect()->route('sdo.index')->with('success', 'SDO record updated successfully.');
    }

    // Delete an SDO record from the database
    public function destroy($id)
    {
        // Find the record by ID
        $record = Sdo::findOrFail($id);
        
        // Delete the record
        $record->delete();

        // Redirect to the SDO records index page with a success message
        return redirect()->route('sdo.index')->with('success', 'SDO record deleted successfully.');
    }
}
