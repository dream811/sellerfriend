<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'tb_countries';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strCountryCode', 'strCountryFlagURL', 'strCountryName', 'strCountryMoneyCode', 'bIsDel'];
    
}
