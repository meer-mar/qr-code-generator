<?php

namespace App\Models;

use App\Traits\PermissionHasRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, PermissionHasRelations;
}
