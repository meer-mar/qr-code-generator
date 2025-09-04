<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'mail_sender_name',
        'mail_host',
        'mail_username',
        'mail_password',
        'mail_port',
        'mail_encryption',
    ];
}
