<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
    protected $table = "tbl_statistical";
    protected $primaryKey = 'id_statistical ';
    protected $fillable = [
        'order_date',
        'total_order',
    ];
}
