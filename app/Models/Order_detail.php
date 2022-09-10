<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'room_id',
        'room_price',
        'room_name',
        'room_sales_quantity',
    ];
}
