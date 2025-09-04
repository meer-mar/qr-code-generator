<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    use HasFactory;
    protected $fillable = ['page_section_id', 'content_data'];
    protected $casts = [
        'content_data' => 'array', // To handle JSON data
    ];

    public function section() {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

}
