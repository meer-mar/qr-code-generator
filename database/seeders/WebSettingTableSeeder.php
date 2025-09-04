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
      // Clear existing records in the web_settings table
      WebSetting::truncate();


      WebSetting::create([
          'site_title' => 'This is the demo title',
          'meta_description' => 'Demo description',
          'logo' => 'default.png',
          'site_url' => 'https://www.sitename.com/',
          'status' => 1,
          'site_fb' => 'https://www.facebook.com/',
          'site_instagram' => 'https://www.instagram.com/',
          'site_twitter' => 'https://www.instagram.com/',
          'site_linkedn' => 'https://www.instagram.com/',
          'site_email' => 'b9b9r@example.com',
          'site_address' => 'Gammi Addah',
          'site_phone' => '0123456789',
          'site_logo' => 'logo.png',
          'site_fav' => 'sitefav.png',
          'site_author' => 'Admin',
          'theme_footer' => 'Copyright © 2024 All Reserved by',
      ]);
  }
}
