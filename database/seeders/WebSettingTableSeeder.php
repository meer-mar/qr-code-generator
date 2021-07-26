<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Seeder;

class WebSettingTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Insert web settings data into db
    WebSetting::create([
      'site_title' => 'This is the demo title',
      'meta_description' => 'Demo description',
      'logo' => 'default.png',
      'site_url' => 'https://www.sitename.com/',
      'status' => 1
    ]);
  }
}
