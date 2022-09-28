<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
    protected $primaryKey = 'id';
    protected $fillable = [
        'payment_method',
        'payment_status',
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    } 

}
