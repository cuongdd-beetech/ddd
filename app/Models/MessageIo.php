<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageIo extends Model
{
    use HasFactory;
    protected $table = "message_ios";
    protected $fillable = ['author', 'content', 'created_at', 'updated_at'];
}
