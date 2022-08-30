<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KindOfRoom extends Model
{
    use HasFactory;
    protected $table = "kind_of_rooms";
    protected $primaryKey = 'id';
    protected $fillable = [
        'kindofroom_name',
        'kindofroom_desc',
        'kindofroom_status',
    ];
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
