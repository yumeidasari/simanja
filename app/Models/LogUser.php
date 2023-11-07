<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{
    use HasFactory;
    protected $table = 'users_log';
    protected $fillable = [
        'id_user',
        'activity'
    ];
}
