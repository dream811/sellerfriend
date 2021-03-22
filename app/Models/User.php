<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'strID',
        'email',
        'phone_number',
        'image',
        'password',
        'bIsAdmin',
        'role',
        'money',
        'business_name',
        'business_number',
        'business_phone',
        'business_type',
        'business_kind',
        'business_zip',
        'business_address1',
        'business_address2',
        'bIsUsed',
        'bIsDel',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'bIsDel',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->bIsAdmin; // this looks for an admin column in your users table
    }

    public function settingCoupang()
    {
        return $this->hasMany(MarketSettingCoupang::class, 'nUserIdx', 'id');
    }
}
