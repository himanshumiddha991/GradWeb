<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
     public function method()
    {
        return $this->hasOne(PaymentMethod::class,'id','method_id');
    }
}
