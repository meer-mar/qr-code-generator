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
    'site_email',
    'site_address',
    'site_phone',
    'site_fb',
    'site_logo',
    'site_instagram',
    'site_twitter',
    'site_linkedin',
    'site_fav',
    'site_footer_logo',
    'theme_footer',
  ];
}
