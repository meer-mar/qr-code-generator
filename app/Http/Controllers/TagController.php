<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    // Show all tags
    public function index()
    {
        // Fetch all tags from the database
        $tags = Tag::all();

        // Return the index view with the tags data
        return view('dashboard.admin.tags.manage', compact('tags'));
    }

    // Show the create tags form
    public function create()
    {
        return view('dashboard.admin.tags.create');
    }

    // Store the new tags in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'nullable|string|max:255',  // Optional title for the tags
            'link' => 'nullable|string|max:255',  // Optional title for the tags

        ]);

        Tag::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
        ]);

        // Redirect back to the tags index with a success message
        return redirect()->route('tags.index')->with('success', 'Tags Added Successfully!');
    }

    // Show the form to edit an existing tags
    public function edit($id)
    {
        // Find the tags by ID
        $tags = Tag::findOrFail($id);
        // Return the edit view with the tags data
        return view('dashboard.admin.tags.edit', compact('tags'));
    }

    // Update the tags in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'nullable|string|max:255',  // Optional title for the tags
            'link' => 'nullable|string|max:255',  // Optional title for the tags
        ]);

        // Find the tags by ID
        $tags = Tag::findOrFail($id);
        // Update the tags details
        $tags->update([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
        ]);

        // Redirect back to the tags index with a success message
        return redirect()->route('tags.index')->with('success', 'Tags Updated Successfully!');
    }

    // Delete the tags from the database
    public function destroy($id)
    {
        // Find the tags by ID
        $tags = Tag::findOrFail($id);

        // Delete the tags record from the database
        $tags->delete();
        // Redirect back to the tags index with a success message
        return redirect()->route('tags.index')->with('success', 'Tags Deleted Successfully!');
    }

}
