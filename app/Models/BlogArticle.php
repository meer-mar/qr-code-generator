<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BlogArticle extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'blog_category_id',
    'author_id',
    'page_title',
    'meta_desc',
    'title',
    'slug',
    'image',
    'content',
    'description',
    'status',
    'views',
  ];

  protected $appends = ['excerpt'];

  /**
   * Get the excerpt of the blog post.
   *
   * @return string
   */
  public function getExcerptAttribute()
  {
      return Str::limit(strip_tags($this->content), 200);
  }

  /**
   * Get the category that owns the blog article.
   */
  public function category()
  {
    return $this->belongsTo(BlogCategory::class, 'blog_category_id');
  }

  /**
   * Get the author of the blog article.
   */
  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  /**
   * Get the tags for the blog article.
   */
  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'blog_article_tag', 'blog_article_id', 'tag_id');
  }

  /**
   * Get the comments for the blog article.
   */
  public function comments()
  {
      return $this->morphMany(Comment::class, 'commentable');
  }

  /**
   * Scope a query to only include featured articles.
   */
  public function scopeFeatured($query)
  {
    return $query->where('is_featured', true)->where('status', 'published');
  }

  /**
   * Scope a query to only include published articles.
   */
  public function scopePublished($query)
  {
    return $query->where('status', 'published');
  }
}
