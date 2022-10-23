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
        'user_id',
        'room_id',
        'content',
        'reply_id'
    ];
    public function cus(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class,'reply_id','id');
    }
    public function index_comment(){
        return $this->hasMany(Comment::class,'reply_id',1);
    }
}
