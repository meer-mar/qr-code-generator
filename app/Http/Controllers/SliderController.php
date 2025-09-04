<?php
namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\BlogArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // Show all sliders
    public function index()
    {
        // Fetch all sliders from the database
        $sliders = Slider::all();

        // Return the index view with the sliders data
        return view('dashboard.admin.sliders.index', compact('sliders'));
    }

    // Show the create slider form
    public function create()
    {
        // Fetch all blog articles for the relation field
        $articles = BlogArticle::all();  // Assuming you have an Article model
        return view('dashboard.admin.sliders.add_slider', compact('articles'));
    }

    // Store the new slider in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'blog_article_id' => 'required|exists:blog_articles,id',  // Validating that the article exists
            'custom_title' => 'nullable|string|max:255',  // Optional title for the slider
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',  // Image is required and must be of type jpeg, png, jpg, or gif and max 2MB
            'priority' => 'required|integer',  // Priority is required for ordering slides
            'is_active' => 'required|boolean',  // Active status is required
        ]);

        if ($request->hasFile('image')) {
            // Save image to folder
            $loc = '/public/blog/article';
            $fileData = $request->file('image');
            $fileNameToStore = 'blog/article/' . $this->uploadImage($fileData, $loc);
          } else {
            $fileNameToStore = 'blog/article/no_img.jpg';
          }

        // Create the new slider
        Slider::create([
            'blog_article_id' => $request->input('blog_article_id'),
            'custom_title' => $request->input('custom_title'),
            'image'       => $fileNameToStore,
            'priority' => $request->input('priority'),
            'is_active' => $request->input('is_active'),
        ]);

        // Redirect back to the slider index with a success message
        return redirect()->route('sliders.index')->with('success', 'Slider added successfully!');
    }

    // Show the form to edit an existing slider
    public function edit($id)
    {
        // Find the slider by ID
        $slider = Slider::findOrFail($id);

        // Fetch all blog articles for the relation field
        $articles = BlogArticle::all();

        // Return the edit view with the slider data
        return view('dashboard.admin.sliders.edit', compact('slider', 'articles'));
    }

    // Update the slider in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'blog_article_id' => 'required|exists:blog_articles,id',
            'custom_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'priority' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        // Find the slider by ID
        $slider = Slider::findOrFail($id);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($slider->image) {
                \Storage::delete('public/' . $slider->image);
            }

            // Upload the new image and store the file path
            $imagePath = $request->file('image')->store('slider_images', 'public');
        } else {
            // Keep the existing image if no new image is uploaded
            $imagePath = $slider->image;
        }

        // Update the slider details
        $slider->update([
            'blog_article_id' => $request->input('blog_article_id'),
            'custom_title' => $request->input('custom_title'),
            'image' => $imagePath,
            'priority' => $request->input('priority'),
            'is_active' => $request->input('is_active'),
        ]);

        // Redirect back to the slider index with a success message
        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully!');
    }

    // Delete the slider from the database
    public function destroy($id)
    {
        // Find the slider by ID
        $slider = Slider::findOrFail($id);

        // Delete the image file from storage if it exists
        if ($slider->image) {
            \Storage::delete('public/' . $slider->image);
        }

        // Delete the slider record from the database
        $slider->delete();

        // Redirect back to the slider index with a success message
        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully!');
    }

    // Helper function to upload image
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
