<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'site_title',
    'meta_description',
    'logo',
    'site_url',
    'status',
  ];

  /**
   * Get Web settings
   *
   * @param int $id
   */
  public function getWebSetting($id)
  {
    return WebSetting::find($id);
  }

  /**
   * Get Web settings
   *
   * @param int $id
   */
  public function updateWebSetting($data = array(), $id)
  {
    $setting = $this->getWebSetting($id);
    return $setting->update($data);
  }
}
