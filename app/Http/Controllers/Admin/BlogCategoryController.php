<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("asdf");
        // Get all data
        $categories = BlogCategory::paginate(10);

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
            'author_id'   => Auth::id(),
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
            return redirect()->route('blog.category.view')
            ->with('success', 'Blog Category Created Successfully');
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
        $category = BlogCategory::findOrFail($id);
        return view('dashboard.admin.blog_category.edit', compact('category'));
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
            'author_id'   => Auth::id(),
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
            return redirect()->route('blog.category.view')
            ->with('success', 'Blog Category Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $action = $request->input('action'); // 'delete' or 'move'

        $category = BlogCategory::with('articles')->findOrFail($id);

        // Delete the category image if needed
        if ($category->image && $category->image !== 'blog/category/image/no_img.jpg') {
            Storage::delete('public/' . $category->image);
        }

        if ($action === 'delete') {
            // Delete related articles and their images
            foreach ($category->articles as $article) {
                if ($article->image && $article->image !== 'blog/article/no_img.jpg') {
                    Storage::delete('public/' . $article->image);
                }
                $article->delete();
            }
        } elseif ($action === 'move') {
            // Get or create the "Uncategorized" category
            $uncategorized = BlogCategory::firstOrCreate(
                ['slug' => 'uncategorized'],
                ['title' => 'Uncategorized', 'status' => 1, 'approval' => 1]
            );

            // Move all articles to "Uncategorized"
            foreach ($category->articles as $article) {
                $article->blog_category_id = $uncategorized->id;
                $article->save();
            }
        }

        $category->delete();

        return redirect()->route('blog.category.view')
            ->with('success', 'Blog Category deleted successfully.');
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


    public function updateStatus(Request $request)
    {
        $blogCategory = BlogCategory::find($request->blog_category_id);

        if ($blogCategory) {
            // Ensure status is only 0 or 1
            if (!in_array($request->status, [0, 1])) {
                return response()->json(['success' => false, 'message' => 'Invalid status value.']);
            }

            $blogCategory->status = $request->status;
            $blogCategory->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Blog category not found.']);
    }


    public function updateApproval(Request $request)
    {
        $blogCategory = BlogCategory::find($request->blog_category_id);

        if ($blogCategory) {
            // Validate the approval status before saving
            $validApprovals = ['Pending', 'Approved', 'Failed'];
            if (!in_array($request->approval, $validApprovals)) {
                return response()->json(['success' => false, 'message' => 'Invalid approval status.']);
            }

            $blogCategory->approval = $request->approval;
            $blogCategory->save();

            return response()->json(['success' => true, 'message' => 'Approval status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Blog category not found.']);
    }

}
