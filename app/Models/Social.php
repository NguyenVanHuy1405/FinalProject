<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_user_id', 'provider', 'user','role_id',
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_social';
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }
    public function roles()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
}
