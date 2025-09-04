<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('dashboard.admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('dashboard.admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Save image to folder
            $loc = '/public/blog/banners';
            $fileData = $request->file('image');
            $fileNameToStore = 'blog/banners/' . $this->uploadImage($fileData, $loc);
          } else {
            $fileNameToStore = 'blog/banners/no_img.jpg';
          }

        Banner::create([
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'image'       => $fileNameToStore,

        ]);

        return redirect()->route('banners.manage')->with('success', 'Banner Created successfully.');
    }

    public function edit(Banner $banners, $id)
    {
      // Get single blog category details
      $banner = Banner::where('id', $id)->first();

      return view('dashboard.admin.banners.edit', ['banner' => $banner]);
    }

    public function update(Request $request, Banner $banners, $id)
  {
    // Validate data
    $this->validate($request, [
      'title'  => 'required|string',
      'image'  => 'image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/blog/banners';
      $fileData = $request->file('image');
      $fileNameToStore = 'blog/banners/' . $this->uploadImage($fileData, $loc);
      $fileData = [
        'image' => $fileNameToStore
      ];

      // Delete previous file
      $banner = $banners->select('id', 'image')->where('id', $id)->first();
      Storage::delete('public/' . $banner->image);
    }

    $data = [
      'title'       => $request->title,
      'meta_desc'   => $request->meta_desc,
    ];

    // Merge all data arrays
    if ($request->hasFile('image')) {
      $data = array_merge($fileData, $data);
    }

    // Update data into db
    $banner = $banners->where('id', $id)->update($data);

    if ($banner) {
      return redirect()->route('banners.manage')->with('success', 'Banner Updated successfully.');
    } else {
      return redirect()->route('banners.update')->with('error', 'Sorry something went wrong!');
    }
  }

  public function destroy(Banner $banners, $id)
  {
    // delete category image
   $banner = $banners->where('id', $id)->first();
    if ($banner->image != 'blog/banners/no_img.jpg') {
      Storage::delete('public/' .$banner->image);
    }

    //Delete user data
   $banner = $banners->destroy($id);

    if ($banner) {
      return redirect()->route('banners.manage')->with('success', 'Banner Deleted Successfully.');
    } else {
      return redirect()->route('banners.manage')->with('error', "Sorry something went wrong!");
    }
  }
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
