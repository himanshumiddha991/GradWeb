<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_spy',
        'admin_id',
        'mobile',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function wallet(){
        return $this->hasMany(Wallet::class, 'user_id','id');
    }
    public function balance($id)
    {
        $credit= Wallet::where('type', 'cr')->where('user_id', $id)->sum("amount");
        $debit= Wallet::where('type', 'dr')->where('user_id', $id)->sum("amount");
        return $credit-$debit;
    }
    
    
}
