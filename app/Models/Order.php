<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'booking_id',
        'payment_id',
        'order_total',
        'order_status',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function booking(){
        return $this->belongsTo('App\Models\Booking');
    } 
    public function order_details(){
        return $this->hasMany('App\Models\OrderDetail');
    }
    public function payment(){
        return $this->belongsTo('App\Models\Payment');
    } 

}
