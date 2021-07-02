<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketSetting extends Model
{
    use HasFactory;
    protected $table = 'tb_market_user_setting';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['nMarketIdx', 'nUserId', 'nMarketAccIdx', 'strTitle', 'nSupportOption', 'nVersion', 'nImageProcessType', 'nTopImageIdx', 'nDownImageIdx', 'created_at', 'updated_at', 'bIsUsed',
                            'bIsDel',
                        ];

    public function marketAccount()
    {
        return $this->belongsTo(MarketAccount::class, 'nMarketAccIdx', 'nIdx');
    }

    public function detail()
    {
        if($this->nMarketIdx == 1){//11번가
            return $this->hasOne(MarketSetting11thhouse::class, 'nSettingIdx', 'nIdx');
        }else if($this->nMarketIdx == 3){//쿠팡
            return $this->hasOne(MarketSettingCoupang::class, 'nSettingIdx', 'nIdx');
        }
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'nMarketIdx', 'nIdx');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nUserId', 'id');
    }

    public function topImage()
    {
        return $this->belongsTo(DocumentImage::class, 'nTopImageIdx', 'nIdx');
    }

    public function downImage()
    {
        return $this->belongsTo(DocumentImage::class, 'nDownImageIdx', 'nIdx');
    }
}
