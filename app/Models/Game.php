<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    public function previous()
    {
        return $this->hasOne(Result::class,'game_id','id');
    }
    public function current()
    {
        return $this->hasOne(Result::class,'game_id','id');
    }
}
