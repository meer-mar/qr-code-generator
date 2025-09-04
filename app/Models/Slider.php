<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_article_id',
        'custom_title',
        'image',
        'priority',
        'is_active',
    ];

    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blog_article_id');
    }
}
