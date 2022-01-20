<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticle extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'category_id',
    'page_title',
    'meta_desc',
    'title',
    'slug',
    'image',
    'description',
    'status',
  ];

  /**
   * Articles relation to category
   *
   */
  public function category()
  {
    return $this->belongsTo(BlogCategory::class, 'category_id');
  }
}
