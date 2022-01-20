<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Get all data
    $categories = BlogCategory::all();

    return view('dashboard.admin.blog_category.index', ['categories' => $categories]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.admin.blog_category.add');
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
    $this->validate($request, [
      'title'  => 'required|string',
      'image'  => 'image|mimes:jpeg,png,jpg,gif,svg',
      'status' => 'required',
    ]);

    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/blog/category';
      $fileData = $request->file('image');
      $fileNameToStore = 'blog/category/' . $this->uploadImage($fileData, $loc);
    } else {
      $fileNameToStore = 'blog/category/no_img.jpg';
    }

    $data = [
      'page_title'  => $request->page_title,
      'meta_desc'   => $request->meta_desc,
      'title'       => $request->title,
      'slug'        => Str::slug($request->title, '-'),
      'description' => $request->description,
      'image'       => $fileNameToStore,
      'status'      => $request->status
    ];

    // Save data into db
    $category = BlogCategory::create($data);

    if ($category) {
      return redirect()->route('blog.category.view')->with('success', 'Record created successfully.');
    } else {
      return redirect()->route('blog.category.add')->with('error', 'Sorry something went wrong!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\BlogCategory  $blogCategory
   * @return \Illuminate\Http\Response
   */
  public function show(BlogCategory $blogCategory)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\BlogCategory  $blogCategory
   * @return \Illuminate\Http\Response
   */
  public function edit(BlogCategory $blogCategory, $id)
  {
    // Get single blog category details
    $category = BlogCategory::where('id', $id)->first();

    return view('dashboard.admin.blog_category.edit', ['category' => $category]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\BlogCategory  $blogCategory
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, BlogCategory $blogCategory, $id)
  {
    // Validate data
    $this->validate($request, [
      'title'  => 'required|string',
      'image'  => 'image|mimes:jpeg,png,jpg,gif,svg',
      'status' => 'required',
    ]);

    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/blog/category';
      $fileData = $request->file('image');
      $fileNameToStore = 'blog/category/' . $this->uploadImage($fileData, $loc);
      $fileData = [
        'image' => $fileNameToStore
      ];

      // Delete previous file
      $category = $blogCategory->select('id', 'image')->where('id', $id)->first();
      Storage::delete('public/' . $category->image);
    }

    $data = [
      'page_title'  => $request->page_title,
      'meta_desc'   => $request->meta_desc,
      'title'       => $request->title,
      'slug'        => Str::slug($request->title, '-'),
      'description' => $request->description,
      'status'      => $request->status
    ];

    // Merge all data arrays
    if ($request->hasFile('image')) {
      $data = array_merge($fileData, $data);
    }

    // Update data into db
    $category = $blogCategory->where('id', $id)->update($data);

    if ($category) {
      return redirect()->route('blog.category.view')->with('success', 'Record updated successfully.');
    } else {
      return redirect()->route('blog.category.update')->with('error', 'Sorry something went wrong!');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\BlogCategory  $blogCategory
   * @return \Illuminate\Http\Response
   */
  public function destroy(BlogCategory $blogCategory, $id)
  {
    // delete category image
    $category = $blogCategory->where('id', $id)->first();
    if ($category->image != 'blog/category/no_img.jpg') {
      Storage::delete('public/' . $category->image);
    }

    //Delete user data
    $category = $blogCategory->destroy($id);

    if ($category) {
      return redirect()->route('blog.category.view')->with('success', 'Record Deleted Successfully.');
    } else {
      return redirect()->route('blog.category.view')->with('error', "Sorry something went wrong!");
    }
  }

  /**
   * Image upload.
   *
   * @param string $field
   * @param string $loc
   * @return \Illuminate\Http\Response
   */
  public function uploadImage($fileData, $loc)
  {
    // Get file name with extension
    $fileNameWithExt = $fileData->getClientOriginalName();
    // Get just file name
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    // Get just extension
    $fileExtension = $fileData->extension();
    // File name to store
    $fileNameToStore = time() . '.' . $fileExtension;
    // Finally Upload Image
    $fileData->storeAs($loc, $fileNameToStore);

    return $fileNameToStore;
  }
}
