<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketAccount extends Model
{
    use HasFactory;
    protected $table = 'tb_market_accounts';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['nMarketIdx', 'nUserId', 'strTitle', 'strAccountId', 'strAccountPwd', 'strVendorId', 'strAPIAccessKey', 'strSecretKey', 'bIsUsed', 'bIsCheckedEnableId', 'bIsDel'];
    
    public function market()
    {
        return $this->belongsTo(Market::class, 'nMarketIdx', 'nIdx');
    }

    public function detailCoupang()
    {
        return $this->hasMany(MarketSettingCoupang::class, 'nMarketAccIdx', 'nIdx');
    }
}
