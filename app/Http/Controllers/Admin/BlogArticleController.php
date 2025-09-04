<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogArticle;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
    $articles = BlogArticle::where('blog_category_id', $id)->paginate(05);

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
      // Generate image name based on title or slug
      $titleSlug = Str::slug($request->title, '-');
      $fileData = $request->file('image');
      $fileNameToStore = $this->uploadImage($fileData, $titleSlug, 'public/blog/article');
    } else {
      $fileNameToStore = 'blog/article/no_img.jpg';
    }

    $data = [
      'blog_category_id' => $id,
      'page_title'  => $request->page_title,
      'meta_desc'   => $request->meta_desc,
      'title'       => $request->title,
      'slug'        => Str::slug($request->title, '-'),
      'description' => $request->description,
      'image'       => $fileNameToStore,
      'status'      => $request->status,
      'author_id'   => Auth::id(), // Set the author ID as the logged-in user's ID
    ];

    $article = BlogArticle::create($data);

    if ($article) {
    return redirect()->route('blog.article.view', ['id' => $id])
    ->with('success', 'Article Created Successfully.');
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
    $category = BlogCategory::where('id', $article->blog_category_id)->first();

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
          'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
          'status' => 'required',
      ]);

      // Get the article
      $article = $blogArticle->where('id', $id)->first();
      $fileNameToStore = $article->image;

      // If a new image is uploaded
      if ($request->hasFile('image')) {
          $fileData = $request->file('image');
          $titleSlug = Str::slug($request->title, '-');
          $loc = 'public/blog/article';

          // Upload new image
          $fileNameToStore = $this->uploadImage($fileData, $titleSlug, $loc);

          // Delete old image (except default)
          if ($article->image !== 'blog/article/no_img.jpg') {
              Storage::delete('public/' . $article->image);
          }
      } else {
          // If title changed, rename existing image (optional)
          if ($article->image && $article->image !== 'blog/article/no_img.jpg') {
              $extension = pathinfo($article->image, PATHINFO_EXTENSION);
              $newFileName = Str::slug($request->title, '-') . '.' . $extension;
              $newPath = 'blog/article/' . $newFileName;

              if ($article->image !== $newPath) {
                  Storage::move('public/' . $article->image, 'public/' . $newPath);
                  $fileNameToStore = $newPath;
              }
          }
      }

      // Prepare data
      $data = [
          'page_title'  => $request->page_title,
          'meta_desc'   => $request->meta_desc,
          'title'       => $request->title,
          'slug'        => Str::slug($request->title, '-'),
          'description' => $request->description,
          'image'       => $fileNameToStore,
          'status'      => $request->status,
          'author_id'   => Auth::id(),
      ];

      // Update DB
      $updated = $blogArticle->where('id', $id)->update($data);

      if ($updated) {
          return redirect()->route('blog.article.view', ['id' => $request->blog_category_id])
              ->with('success', 'Article Updated Successfully.');
      }
  }




  /**
   * Generate a unique file name for the image.
   *
   * @param string $fileName
   * @param string $fileExtension
   * @param string $directory
   * @return string
   */
  private function generateUniqueFileName($fileName, $fileExtension, $directory)
  {
      $counter = 1;
      $fileNameToStore = $fileName . '.' . $fileExtension;

      while (Storage::exists($directory . '/' . $fileNameToStore)) {
          $fileNameToStore = $fileName . '-' . $counter . '.' . $fileExtension;
          $counter++;
      }

      return $fileNameToStore;
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
    $article = $blogArticle->select('id', 'blog_category_id', 'image')->where('id', $id)->first();
    if ($article->image != 'blog/article/no_img.jpg') {
      Storage::delete('public/' . $article->image);
    }

    //Delete user data
    $result = $blogArticle->destroy($id);

    if ($result) {
        return redirect()->route('blog.article.view', ['id' => $article->id])
    ->with('success', 'Article Created Successfully.');
    }
  }

  /**
   * Image upload.
   *
   * @param string $field
   * @param string $loc
   * @return \Illuminate\Http\Response
   */
  public function uploadImage($fileData, $titleSlug, $loc)
  {
      $extension = $fileData->extension();
      $fileName = $titleSlug;
      $counter = 0;

      // Ensure the file name is unique
      while (Storage::exists($loc . '/' . $fileName . ($counter ? "-$counter" : '') . '.' . $extension)) {
          $counter++;
      }

      $finalFileName = $fileName . ($counter ? "-$counter" : '') . '.' . $extension;

      // Store in public storage (storage/app/public/blog/article)
      $fileData->storeAs($loc, $finalFileName);

      // Return only the relative path to store in DB: blog/article/filename
      return str_replace('public/', '', $loc) . '/' . $finalFileName;
  }



  public function updateStatus(Request $request)
  {
      $article = BlogArticle::find($request->article_id);

      if ($article) {
          $article->status = $request->status == 1 ? 1 : 0; // Ensure boolean value
          $article->save();
          return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
      }

      return response()->json(['success' => false, 'message' => 'Article not found.']);
  }

  public function updateApproval(Request $request)
  {
      $article = BlogArticle::find($request->article_id);

      if ($article) {
          // Ensure that the approval status matches allowed ENUM values
          $allowedStatuses = ['Pending', 'Approved', 'Failed'];
          if (!in_array($request->approval, $allowedStatuses)) {
              return response()->json(['success' => false, 'message' => 'Invalid approval status.']);
          }

          $article->approval = $request->approval;
          $article->save();

          return response()->json(['success' => true, 'message' => 'Approval status updated successfully.']);
      }

      return response()->json(['success' => false, 'message' => 'Article not found.']);
  }


}
