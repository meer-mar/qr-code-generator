<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageSectionController extends Controller
{
    public function index($pageId)
    {
        $page = Page::with('sections')->findOrFail($pageId);
        return view('dashboard.admin.site_pages.sections.index', compact('page'));
    }

    public function create($pageId)
    {
        $page = Page::findOrFail($pageId);
        return view('dashboard.admin.site_pages.sections.create', compact('page'));
    }

    public function store(Request $request, $pageId)
    {
        $request->validate([
            'sections.*.title' => 'required|string|max:255',
            'sections.*.content' => 'required|string',
            'sections.*.sort_order' => 'nullable|integer',
            'sections.*.status' => 'boolean',
        ]);

        foreach ($request->sections as $section) {
            PageSection::create([
                'page_id' => $pageId,
                'section_title' => $section['title'],
                'section_content' => $section['content'],
                'sort_order' => $section['sort_order'] ?? 0,
                'status' => $section['status'] ?? 1,
            ]);
        }

        return redirect()->route('view.sections', $pageId)
        ->with('success', 'Page Section Added Successfully!');
    }






    public function showContentForm($sectionId)
    {
        $section = PageSection::findOrFail($sectionId);
        return view('dashboard.admin.site_pages.sections.content_form', compact('section'));
    }

    public function storeContent(Request $request, $sectionId)
    {
        $validated = $request->validate([
            'section_content' => 'required|string',
        ]);

        $section = PageSection::findOrFail($sectionId);
        $section->update([
            'section_content' => $validated['section_content']
        ]);

        return redirect()->route('view.sections', $section->page_id)
                         ->with('success', 'Section content updated successfully.');
    }
    // Edit section
public function edit($id)
{
    $section = PageSection::findOrFail($id);
    return view('dashboard.admin.site_pages.sections.edit', compact('section'));
}
public function update(Request $request, $section)
{
    $request->validate([
        'section_title'   => 'required|string|max:255',
        'section_content' => 'required',
        'sort_order'      => 'nullable|integer',
        'status'          => 'nullable|boolean',
    ]);

    $section = PageSection::findOrFail($section);

    if ($section->update([
        'section_title'   => $request->section_title,
        'section_content' => $request->section_content,
        'sort_order'      => $request->sort_order ?? 0,
        'status'          => $request->status ?? 1,
    ])) {
        return redirect()->route('view.sections', ['pageId' => $section->page_id])
            ->with([
                'alert-type' => 'success',
                'message'    => 'Page Section Updated',
            ]);
    } else {
        return redirect()->route('view.sections', ['pageId' => $section->page_id])
            ->with([
                'alert-type' => 'error',
                'message'    => 'Error While Updating',
            ]);
    }
}

// Delete section
public function destroy($id)
    {
        $section = PageSection::findOrFail($id);
        $section->delete();
        return redirect()->route('view.sections', ['pageId' => $section->page_id])
        ->with('success', 'Section Deleted successfully.');
    }
    public function getSectionContent($id)
    {
        $section = PageSection::find($id);

        if (!$section) {
            return response()->json(['error' => 'Section not found'], 404);
        }

        $contents = SectionContent::where('page_section_id', $id)->get();

        return response()->json($contents);
    }

}
