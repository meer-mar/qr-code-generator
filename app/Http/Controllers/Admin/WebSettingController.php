<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebSetting;
use App\Models\BlogCategory;
use App\Models\HomePageCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faqs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Models\SMTPSetting;
class WebSettingController extends Controller
{
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\WebSetting  $webSetting
   * @return \Illuminate\Http\Response
   */
  public function edit(WebSetting $webSetting, $id)
  {
      $webSettings = $webSetting->findOrFail($id);
      $categories = BlogCategory::all(); // Fetch all categories

      $selectedCategories = json_decode($webSettings->categories, true);
      return view('dashboard.admin.web_setting.edit', compact('webSettings', 'categories', 'selectedCategories'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\WebSetting  $webSetting
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, WebSetting $webSetting, $id)
  {
      // Validate data (only validate fields that are present in the request)
      $valid = $request->validate([
        'site_title' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'logo' => 'nullable|image|max:2048',
        'site_logo' => 'nullable|image|max:2048',
        'site_footer_logo' => 'nullable|image|max:2048',
        'site_fav' => 'nullable|image|max:2048',
        'site_url' => 'nullable|string',
        'site_address' => 'nullable|string',
        'status' => 'nullable',
        'site_fb' => 'nullable|string',
        'site_instagram' => 'nullable|string',
        'site_twitter' => 'nullable|string',
        'site_linkedn' => 'nullable|string',
        'site_email' => 'nullable|string',
        'site_phone' => 'nullable|string',
        'theme_footer' => 'nullable|string',
    ]);

      // Initialize an empty array to hold the data to be updated
      $data = [];

      // Add fields to the $data array only if they are present in the request
      if ($request->has('site_title')) {
          $data['site_title'] = $valid['site_title'];
      }
      if ($request->has('meta_description')) {
          $data['meta_description'] = $valid['meta_description'];
      }
      if ($request->has('site_url')) {
          $data['site_url'] = $valid['site_url'];
      }
      if ($request->has('site_address')) {
          $data['site_address'] = $valid['site_address'];
      }
      if ($request->has('status')) {
          $data['status'] = $valid['status'];
      }
      if ($request->has('site_fb')) {
          $data['site_fb'] = $valid['site_fb'];
      }
      if ($request->has('site_instagram')) {
          $data['site_instagram'] = $valid['site_instagram'];
      }
      if ($request->has('site_twitter')) {
          $data['site_twitter'] = $valid['site_twitter'];
      }
      if ($request->has('site_linkedn')) {
          $data['site_linkedn'] = $valid['site_linkedn'];
      }
      if ($request->has('site_email')) {
          $data['site_email'] = $valid['site_email'];
      }
      if ($request->has('site_phone')) {
          $data['site_phone'] = $valid['site_phone'];
      }
      if ($request->has('theme_footer')) {
          $data['theme_footer'] = $valid['theme_footer'];
      }

      // Handle file uploads only if files are present in the request
      if ($request->hasFile('logo')) {
          $data['logo'] = $this->handleFileUpload($request, 'logo', 'logo2');
      }
      if ($request->hasFile('site_logo')) {
          $data['site_logo'] = $this->handleFileUpload($request, 'site_logo', 'site_logo2');
      }
      if ($request->hasFile('site_footer_logo')) {
          $data['site_footer_logo'] = $this->handleFileUpload($request, 'site_footer_logo', 'site_footer_logo2');
      }
      if ($request->hasFile('site_fav')) {
          $data['site_fav'] = $this->handleFileUpload($request, 'site_fav', 'site_fav2');
      }

      // Update WebSetting data into db
      $webSetting = $webSetting->where('id', $id)->update($data);

      // Check if webSetting was updated
      if ($webSetting){
        return redirect()->back()->with('success', 'Record updated successfully.');
    }

    // If save fails, just reload the page silently
    return redirect()->back()->with('error', 'Something Went Wrong.');
  }

  /**
   * Handle file upload.
   *
   * @param \Illuminate\Http\Request $request
   * @param string $fileField
   * @param string $oldFileField
   * @return string
   */
  private function handleFileUpload($request, $fileField, $oldFileField)
  {
      if ($request->hasFile($fileField)) {
          $loc = '/public/settings';
          $fileData = $request->file($fileField);
          $fileNameToStore = $this->uploadImage($fileData, $loc);
          Storage::delete('public/settings/' . $request->input($oldFileField));
      } else {
          $fileNameToStore = $request->input($oldFileField);
      }

      return $fileNameToStore;
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
      $fileExtension = $fileData->getClientOriginalExtension();
      // File name to store
      $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtension;
      // Finally Upload Image
      $fileData->storeAs($loc, $fileNameToStore);

      return $fileNameToStore;
  }



  public function setting()
  {
      return view("website.backend.all_setting");
  }

  public function smtp() {
    $smtp = SMTPSetting::first();
    return view("website.backend.smtp_details", compact('smtp'));
}

public function updateSMTP(Request $request) {
    // Validate input
    $validated = $request->validate([
        'mail_host' => 'required|string',
        'mail_port' => 'required|integer',
        'mail_username' => 'required|string',
        'mail_password' => 'required|string',
        'mail_encryption' => 'required|string',
        'mail_sender_name' => 'required|string',
    ]);

    // Update database
    $smtp = SMTPSetting::first();
    if ($smtp) {
        $smtp->update($validated);
    } else {
        SMTPSetting::create($validated);
    }

    // Update .env file
    $this->updateEnv([
        'MAIL_HOST' => $validated['mail_host'],
        'MAIL_PORT' => $validated['mail_port'],
        'MAIL_USERNAME' => $validated['mail_username'],
        'MAIL_PASSWORD' => $validated['mail_password'],
        'MAIL_ENCRYPTION' => $validated['mail_encryption'],
        'MAIL_FROM_ADDRESS' => $validated['mail_username'],
        'MAIL_FROM_NAME' => '"' . $validated['mail_sender_name'] . '"', // Quotes for names with spaces
    ]);

    // Clear and cache config
    Artisan::call('config:clear');

    return redirect()->back()->with('success', 'SMTP settings updated successfully.');
}

/**
 * Update .env file dynamically
 */
private function updateEnv(array $data) {
    $envFile = base_path('.env');
    $envContent = file_get_contents($envFile);

    foreach ($data as $key => $value) {
        // Ensure values with spaces are enclosed in double quotes
        if (preg_match('/\s/', $value)) {
            $value = '"' . addslashes($value) . '"'; // Escape double quotes if needed
        }

        $pattern = "/^{$key}=.*/m";
        $replacement = "{$key}={$value}";

        // If key exists, replace it; otherwise, append it
        if (preg_match($pattern, $envContent)) {
            $envContent = preg_replace($pattern, $replacement, $envContent);
        } else {
            $envContent .= "\n{$replacement}";
        }
    }

    file_put_contents($envFile, $envContent);
}
public function websetting()
{
    $settings = WebSetting::first();
    return view("website.backend.websetting",compact('settings'));
}

/*
|--------------------------------------------------------------------------
| Show Cache Clear Page
|--------------------------------------------------------------------------
*/
public function cache()
{
          return view("website.backend.cache");
}
/*
|--------------------------------------------------------------------------
| Cache Clear Funtion
|--------------------------------------------------------------------------
*/
public function clearCache()
{
          // Clear the application cache
          Artisan::call('cache:clear');

          // Clear the view cache
          Artisan::call('view:clear');

          // Clear the route cache
          Artisan::call('route:clear');

          // Clear the config cache
          Artisan::call('config:clear');

          // Optionally, you can clear other caches as well
          Artisan::call('optimize:clear');

          // Redirect back to the cache page with a success message
          return redirect()->route('cache-clear.page')->with('success', 'Cache cleared successfully!');
}
  }
