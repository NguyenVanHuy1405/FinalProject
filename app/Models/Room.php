<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ModelsKindOfRoom;
use App\Models\RoomType;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "rooms";
    protected $primaryKey = 'id';
    protected $fillable = [
        'room_name',
        'romtype_id',
        'kindofroom_id',
        'room_description',
        'room_content',
        'room_price',
        'room_image',
        'room_status',
    ];
    public function kindofroom(){
        return $this->belongsTo(KindOfRoom::class);
    }
    public function roomtype(){
        return $this->belongsTo(RoomType::class);
    }
}
