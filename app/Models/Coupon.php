<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $primaryKey = 'id';
    protected $fillable = [
        'coupon_name',
        'coupon_time',
        'coupon_date_start',
        'coupon_date_end',
        'coupon_condition',
        'coupon_number',
        'coupon_code',
    ];
}
