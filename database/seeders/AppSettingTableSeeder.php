<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Insert admin dashboard basic info into db
    AppSetting::create([
      'name' => 'CMS',
      'logo' => 'default.png'
    ]);
  }
}
