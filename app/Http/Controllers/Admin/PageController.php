<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Get all pages
    $pages = Page::all();

    return view('dashboard.admin.site_pages.index', compact('pages'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.admin.site_pages.add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      // Validate data
      $valid = $this->validate($request, [
          'title' => 'required|string',
          'slug' => 'required|string|unique:pages,slug', // Slug comes from form and must be unique
          'meta_desc' => 'required|string',
          'page_name' => 'required|string',
          'page_desc' => 'required',
          'status' => 'required',
          'sections' => 'nullable|array', // Sections are optional
          'sections.*.title' => 'required_with:sections|string', // Validate only if sections exist
          'sections.*.content' => 'required_with:sections|string', // Validate only if sections exist
      ]);

      // Save page data
      $page = Page::create([
          'title' => $valid['title'],
          'slug' => Str::slug($valid['slug'], '-'), // Use slug from the form
          'meta_desc' => $valid['meta_desc'],
          'page_name' => $valid['page_name'],
          'page_desc' => $valid['page_desc'],
          'status' => $valid['status']
      ]);

      // Save sections only if they exist
      if ($page && !empty($valid['sections'])) {
          foreach ($valid['sections'] as $sectionData) {
              PageSection::create([
                  'page_id' => $page->id,
                  'section_title' => $sectionData['title'],
                  'section_content' => $sectionData['content'],
                  'status' => 1, // Default status
                  'sort_order' => 0, // Default sort order
              ]);
          }
      }

      return redirect('/admin/pages')->with('success', 'Record created successfully.');
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function show(Page $page)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function edit(Page $page, $id)
  {
      // Get single page details with its sections
      $page = Page::with('sections')->findOrFail($id);

      return view('dashboard.admin.site_pages.edit', compact('page'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Page $page, $id)
  {
      // Validate data
      $valid = $this->validate($request, [
          'title' => 'required|string',
          'slug' => 'required|string|unique:pages,slug,' . $id, // Allow slug from form, must be unique except for this page
          'meta_desc' => 'required|string',
          'page_name' => 'required|string',
          'page_desc' => 'required',
          'status' => 'required',
          'sections' => 'nullable|array', // Sections are optional
          'sections.*.title' => 'required_with:sections|string', // Validate only if sections exist
          'sections.*.content' => 'required_with:sections|string', // Validate only if sections exist
      ]);

      // Fetch the page
      $page = Page::find($id);
      if (!$page) {
          return redirect('/admin/pages')->with('error', 'Page not found!');
      }

      // Update page data, keeping the slug from the form
      $page->update([
          'title' => $valid['title'],
          'slug' => Str::slug($valid['slug'], '-'), // Use slug from form
          'meta_desc' => $valid['meta_desc'],
          'page_name' => $valid['page_name'],
          'page_desc' => $valid['page_desc'],
          'status' => $valid['status']
      ]);

      // Update sections only if they exist
      if (!empty($valid['sections'])) {
          // Delete existing sections
          $page->sections()->delete();

          // Add updated sections
          foreach ($valid['sections'] as $sectionData) {
              PageSection::create([
                  'page_id' => $page->id,
                  'section_title' => $sectionData['title'],
                  'section_content' => $sectionData['content'],
                  'status' => 1, // Default status
                  'sort_order' => 0, // Default sort order
              ]);
          }
      }

      return redirect('/admin/pages')->with('success', 'Record updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function destroy(Page $page, $id)
  {
    // Delete page
    $page = Page::destroy($id);

    if ($page) {
      return redirect('/admin/pages')->with('success', 'Record Deleted Successfully.');
    } else {
      return redirect('/admin/pages')->with('error', "Record not deleted!");
    }
  }
}
