<?php
namespace App\Http\Controllers;

use App\Models\UserEducation;
use Illuminate\Http\Request;

class UserEducationController extends Controller
{
    // Fetch all records for a user
    public function index($userId)
    {
        $education = UserEducation::where('user_id', $userId)->get();
        return view('dashboard.admin.education.manage', compact('education'));
    }

    // Show the form to create a new record
    public function create()
    {
        return view('dashboard.admin.education.create');
    }
    public function store(Request $request)
    {
        // Get all education records from the request
        $educationRecords = $request->input('education');

        // Get the authenticated user's ID
        $userId = auth()->user()->id;

        // Iterate through each record and save it
        foreach ($educationRecords as $record) {
            UserEducation::create([
                'user_id' => $userId, // Add user ID
                'organization' => $record['organization'],
                'degree' => $record['degree'],
                'start_date' => $record['start_date'],
                'end_date' => $record['end_date'] ?? null,
                'current' => $record['current'],
            ]);
        }

        // Redirect after all records are saved
        return redirect()->route('education.manage', ['userId' => $userId])
                         ->with('success', 'Education records created successfully.');
    }



    // Show the form to edit a record
    public function edit($userId, $id)
    {
        $educationRecords = UserEducation::where('user_id', $userId)->get();
        return view('dashboard.admin.education.edit', compact('educationRecords', 'userId'));
    }

    // Update a record
    public function update(Request $request, $userId)
    {
        // Fetch all submitted education records
        $educationRecords = $request->input('education');

        // Delete existing education records for the user
        UserEducation::where('user_id', $userId)->delete();

        // Save the updated records
        foreach ($educationRecords as $record) {
            UserEducation::create([
                'user_id' => $userId,
                'organization' => $record['organization'],
                'degree' => $record['degree'],
                'start_date' => $record['start_date'],
                'end_date' => $record['end_date'] ?? null,
                'current' => $record['current'],
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('education.manage', ['userId' => $userId])
        ->with('success', 'Education records updated successfully.');
    }


    // Delete a record
    public function destroy($id)
    {
        $education = UserEducation::findOrFail($id);
        $userId = $education->user_id;
        $education->delete();

        return redirect()->route('education.manage', $userId)->with('success', 'Education record deleted successfully.');
    }
}
