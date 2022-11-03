<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = "order_details";
    protected $fillable = [
        'order_id',
        'room_id',
        'room_price',
        'room_name',
        'room_sales_quantity',
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function Rooms(){
        return $this->hasOne(Room::class);
    }
}
