<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = "room_types";
    protected $primaryKey = 'id';
    protected $fillable = [
        'roomtype_name',
        'roomtype_desc',
        'roomtype_status',
    ];
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
