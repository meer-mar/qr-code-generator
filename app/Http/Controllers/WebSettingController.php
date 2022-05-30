<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    return view('dashboard.admin.web_setting.edit', compact('webSettings'));
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\WebSetting  $webSetting
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, WebSetting $webSetting, $id)
  {
    // Validate data
    $valid = $this->validate($request, [
      'site_title' => 'required|string',
      'meta_description' => 'string',
      'logo' => 'image|max:2048',
      'site_url' => 'string',
      'status' => 'required'
    ]);

    // Check file updated or not else save default file
    if ($request->hasFile('logo')) {
      // Save image to folder
      $loc = '/public/settings';
      $fileData = $request->file('logo');
      $fileNameToStore = $this->uploadImage($fileData, $loc);

      // Delete previous file if update file
      Storage::delete('public/settings/' . $request->input('logo2'));
    } else {
      $fileNameToStore = $request->input('logo2');
    }

    // Finalize filter data ready to update
    $data = [
      'site_title' => $valid['site_title'],
      'meta_description' => $valid['meta_description'],
      'logo' => $fileNameToStore,
      'site_url' => $valid['site_url'],
      'status' => $valid['status']
    ];

    // Update data into db
    $webSetting = $webSetting->where('id', $id)->update($data);

    if ($webSetting) {
      return redirect('/admin/web-setting/edit/1')->with('success', 'Record updated successfully.');
    } else {
      return redirect('/admin/web-setting/edit/1')->with('error', 'Record not updated!');
    }
  }
}
