<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;
    protected $table = 'user_education';

    protected $fillable = [
        'user_id',
        'organization',
        'degree',
        'start_date',
        'end_date',
        'current',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class ,'id', 'user_id');
    }
}
