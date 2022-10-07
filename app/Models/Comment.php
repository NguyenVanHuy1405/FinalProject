<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $primaryKey = 'id';
    protected $fillable = [
        'comment',
        'comment_name',
        'comment_date',
        'comment_room_id'
    ];
}
