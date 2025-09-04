<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id', 'section_title', 'section_content', 'sort_order', 'status'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function contents()
{
    return $this->hasMany(SectionContent::class);
}

}
