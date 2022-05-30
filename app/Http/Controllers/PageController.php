<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

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
      'meta_desc' => 'required|string',
      'page_name' => 'required|string',
      'page_desc' => 'required',
      'status' => 'required',
    ]);

    $data = [
      'title' => $valid['title'],
      'meta_desc' => $valid['meta_desc'],
      'page_name' => $valid['page_name'],
      'page_desc' => $valid['page_desc'],
      'status' => $valid['status']
    ];

    // Save data into db
    $page = Page::create($data);

    if ($page) {
      return redirect('/admin/pages')->with('success', 'Record created successfully.');
    } else {
      return redirect('/admin/pages')->with('error', 'Record not created!');
    }
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
    // Get single page details
    $page = Page::findOrFail($id);

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
      'meta_desc' => 'required|string',
      'page_name' => 'required|string',
      'page_desc' => 'required',
      'status' => 'required',
    ]);

    $data = [
      'title' => $valid['title'],
      'meta_desc' => $valid['meta_desc'],
      'page_name' => $valid['page_name'],
      'page_desc' => $valid['page_desc'],
      'status' => $valid['status']
    ];

    // Update data into db
    $page = Page::find($id);
    $page = $page->update($data);

    if ($page) {
      return redirect('/admin/pages')->with('success', 'Record updated successfully.');
    } else {
      return redirect('/admin/pages')->with('error', 'Record not updated!');
    }
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
