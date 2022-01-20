<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    // Get category by id
    $category = BlogCategory::where('id', $id)->first();

    // Get all data
    $articles = BlogArticle::where('category_id', $id)->get();

    return view('dashboard.admin.blog_article.index', ['articles' => $articles, 'category' => $category]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    // Get category by id
    $category = BlogCategory::where('id', $id)->first();

    return view('dashboard.admin.blog_article.add', ['category' => $category]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    // Validate data
    $this->validate($request, [
      'title'  => 'required|string',
      'image'  => 'image|mimes:jpeg,png,jpg,gif,svg',
      'status' => 'required',
    ]);

    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/blog/article';
      $fileData = $request->file('image');
      $fileNameToStore = 'blog/article/' . $this->uploadImage($fileData, $loc);
    } else {
      $fileNameToStore = 'blog/article/no_img.jpg';
    }

    $data = [
      'category_id' => $id,
      'page_title'  => $request->page_title,
      'meta_desc'   => $request->meta_desc,
      'title'       => $request->title,
      'slug'        => Str::slug($request->title, '-'),
      'description' => $request->description,
      'image'       => $fileNameToStore,
      'status'      => $request->status
    ];

    // Save data into db
    $article = BlogArticle::create($data);

    if ($article) {
      return redirect()->route('blog.article.view', ['id' => $id])->with('success', 'Record created successfully.');
    } else {
      return redirect()->route('blog.article.add', ['id' => $id])->with('error', 'Sorry something went wrong!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function show(BlogArticle $blogArticle)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function edit(BlogArticle $blogArticle, $id)
  {
    // Get single blog category details
    $article = BlogArticle::where('id', $id)->first();

    // Get single blog category details
    $category = BlogCategory::where('id', $article->category_id)->first();

    return view('dashboard.admin.blog_article.edit', ['article' => $article, 'category' => $category]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, BlogArticle $blogArticle, $id)
  {
    // Validate data
    $this->validate($request, [
      'title'  => 'required|string',
      'image'  => 'image|mimes:jpeg,png,jpg,gif,svg',
      'status' => 'required',
    ]);

    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/blog/article';
      $fileData = $request->file('image');
      $fileNameToStore = $this->uploadImage($fileData, $loc);
      $fileData = [
        'image' => 'blog/article/' . $fileNameToStore
      ];

      // Delete previous file
      $article = $blogArticle->select('id', 'image')->where('id', $id)->first();
      Storage::delete('public/' . $article->image);
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
    $article = $blogArticle->where('id', $id)->update($data);

    if ($article) {
      return redirect()->route('blog.article.view', ['id' => $request->category_id])->with('success', 'Record updated successfully.');
    } else {
      return redirect()->route('blog.article.view', ['id' => $request->category_id])->with('error', 'Sorry something went wrong!');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\BlogArticle  $blogArticle
   * @return \Illuminate\Http\Response
   */
  public function destroy(BlogArticle $blogArticle, $id)
  {
    // delete category image
    $article = $blogArticle->select('id', 'category_id', 'image')->where('id', $id)->first();
    if ($article->image != 'blog/article/no_img.jpg') {
      Storage::delete('public/' . $article->image);
    }

    //Delete user data
    $result = $blogArticle->destroy($id);

    if ($result) {
      return redirect()->route('blog.article.view', ['id' => $article->category_id])->with('success', 'Record updated successfully.');
    } else {
      return redirect()->route('blog.article.view', ['id' => $article->category_id])->with('error', 'Sorry something went wrong!');
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
