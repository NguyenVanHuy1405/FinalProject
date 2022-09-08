<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "bookings";
    protected $primaryKey = 'id';
    protected $fillable = [
        'booking_name',
        'booking_email',
        'booking_address',
        'booking_phone',
        'booking_note',
    ];
}