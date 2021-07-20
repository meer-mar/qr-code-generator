<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'logo'
  ];

  /**
   * Get App settings
   *
   * @param int $id
   */
  public function getAppSetting($id)
  {
    return AppSetting::find($id);
  }

  /**
   * Get App settings
   *
   * @param int $id
   */
  public function updateAppSetting($data = array(), $id)
  {
    $setting = $this->getAppSetting($id);
    return $setting->update($data);
  }
}
