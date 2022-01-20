<?php

namespace App\Models;

use App\Models\BlogArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'page_title',
    'meta_desc',
    'title',
    'slug',
    'image',
    'description',
    'status',
  ];

  /**
   * Categories relation to articles
   *
   */
  public function articles()
  {
    return $this->hasMany(BlogArticle::class);
  }
}
