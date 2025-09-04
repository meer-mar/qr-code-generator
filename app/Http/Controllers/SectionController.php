<?php

namespace App\Http\Controllers;
use App\Models\PageSection;
use App\Models\SectionContent;
use Illuminate\Http\Request;


class SectionController extends Controller
{


    public function indexContent($id)
    {
        $contents = SectionContent::where('page_section_id', $id)->get();
        return view('dashboard.admin.site_pages.sections.index', compact('contents', 'id'));
    }

//newfuntion
public function store(Request $request, $sectionId)
{
    $contentData = json_decode($request->input('content_data'), true);

    // Remove unwanted fields
    unset($contentData['_token'], $contentData['_method']);

    // Remove empty fields
    $contentData = array_filter($contentData, function ($value) {
        return !empty($value);
    });

    // Handle file upload separately
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public'); // Store in 'public/uploads'
        $contentData['image'] = $imagePath; // Save image path in JSON
    }

    // Handle additional file uploads
    foreach ($request->allFiles() as $key => $file) {
        if ($key !== 'image') {
            $filePath = $file->store('uploads', 'public');
            $contentData[$key] = $filePath;
        }
    }

    SectionContent::create([
        'page_section_id' => $sectionId,
        'content_data' => $contentData, // Store as an array, Laravel will automatically convert to JSON
    ]);

    return back()->with('success', 'Content saved successfully!');
}

public function update(Request $request, $id)
{
    $contentData = json_decode($request->input('content_data'), true);

    // Remove unwanted fields
    unset($contentData['_token'], $contentData['_method']);

    // Remove empty fields
    $contentData = array_filter($contentData, function ($value) {
        return !empty($value);
    });

    // Handle file upload separately
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public'); // Store in 'public/uploads'
        $contentData['image'] = $imagePath; // Save image path in JSON
    }

    // Handle additional file uploads
    foreach ($request->allFiles() as $key => $file) {
        if ($key !== 'image') {
            $filePath = $file->store('uploads', 'public');
            $contentData[$key] = $filePath;
        }
    }

    $sectionContent = SectionContent::findOrFail($id);
    $sectionContent->update([
        'content_data' => $contentData, // Store as an array, Laravel will automatically convert to JSON
    ]);

    return back()->with('success', 'Content updated successfully!');
}






}
