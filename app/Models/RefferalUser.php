<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefferalUser extends Model
{
    use HasFactory;
    public function receiver()
    {
        return $this->hasOne(User::class,'id','receiver_id');
    }
    public function giver()
    {
        return $this->hasOne(User::class,'id','giver_id');
    }
    public function refferal_amount()
    {
        return $this->hasMany(RefferalAmount::class,'ref_id','id');
    }
}
