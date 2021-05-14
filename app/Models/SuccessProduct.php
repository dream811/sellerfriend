<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessProduct extends Model
{
    use HasFactory;
    protected $table = 'tb_success_products';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['strId', 'strSolutionId', 'strURL', 'strMainName', 'strSubName', 'nUserId', 'nMarketSetIdx', 'nBrandType', 'strBrand', 'strKeyword', 'strOption', 'strOptionValue', 'strChMainName', 'strKrMainName', 'strChSubName', 'strKrSubName', 'strComeCode', 'strCategoryCode0', 'strCategoryCode1', 'strCategoryCode2', 'strCategoryCode3', 'strCategoryCode4', 'strCategoryCode5', 'strCategoryCode6', 'strCategoryCode7', 'strCategoryCode8', 'nShareType', 'nProductWorkProcess', 
    'bReg11thhouse', 'bRegAuction', 'bRegCoupang', 'bRegGmarket', 'bRegInterpark', 'bRegLotteon', 'bRegSmartstore', 'bRegTmon', 'bRegWemakeprice', 'created_at', 'updated_at', 'bIsDel'];
    public function productImages()
    {
        return $this->hasMany(SuccessProductImage::class, 'nProductIdx', 'nIdx');
    }
    public function productDetail()
    {
        return $this->hasOne(SuccessProductDetail::class, 'nProductIdx', 'nIdx');
    }
    public function productMarketSetting()
    {
        return $this->belongsTo(MarketSettingCoupang::class, 'nMarketSetIdx', 'nIdx');
    }
    public function productRegCoupang()
    {
        return $this->hasMany(SuccessProductRegCoupang::class, 'nProductIdx', 'nIdx');
    }
    public function productReg11thhouse()
    {
        return $this->hasMany(SuccessProductReg11thhouse::class, 'nProductIdx', 'nIdx');
    }
    public function productRegAuction()
    {
        return $this->hasMany(SuccessProductRegAuction::class, 'nProductIdx', 'nIdx');
    }
    public function productRegGmarket()
    {
        return $this->hasMany(SuccessProductRegGmarket::class, 'nProductIdx', 'nIdx');
    }
    public function productRegInterpark()
    {
        return $this->hasMany(SuccessProductRegInterpark::class, 'nProductIdx', 'nIdx');
    }
    public function productLotteon()
    {
        return $this->hasMany(SuccessProductRegLotteon::class, 'nProductIdx', 'nIdx');
    }
    public function productSmartstore()
    {
        return $this->hasMany(SuccessProductSmartstore::class, 'nProductIdx', 'nIdx');
    }
    public function productTmon()
    {
        return $this->hasMany(SuccessProductRegTmon::class, 'nProductIdx', 'nIdx');
    }
    public function productWemakeprice()
    {
        return $this->hasMany(SuccessProductWemakeprice::class, 'nProductIdx', 'nIdx');
    }
    public function productItems()
    {
        return $this->hasMany(SuccessProductItem::class, 'nProductIdx', 'nIdx');
    }
}
