<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedProduct extends Model
{
    use HasFactory;
    protected $table = 'tb_failed_products';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['strId', 'strSolutionId', 'strURL', 'strMainName', 'strSubName', 'nUserId', 'nMarketSetIdx', 'nBrandType', 'strBrand', 'strKeyword', 
    'strKoOption', 'strKoOptionValue', 'strCnOption', 'strCnOptionValue', 'strOptionPrice', 'blobOptionImage', 'strChMainName', 'strKrMainName', 'strChSubName', 'strKrSubName', 
    'strComeCode', 'strCategoryCode0', 'strCategoryCode1', 'strCategoryCode2', 'strCategoryCode3', 'strCategoryCode4', 'strCategoryCode5', 'strCategoryCode6', 
    'strCategoryCode7', 'strCategoryCode8', 'nShareType', 'nProductWorkProcess', 'bReg11thhouse', 'bRegAuction', 'bRegCoupang', 'bRegGmarket', 'bRegInterpark', 
    'bRegLotteon', 'bRegSmartstore', 'bRegTmon', 'bRegWemakeprice', 'created_at', 'updated_at', 'strReason', 'bIsDel'];
    public function productImages()
    {
        return $this->hasMany(FailedProductImage::class, 'nProductIdx', 'nIdx');
    }
    
    public function productDetail()
    {
        return $this->hasOne(FailedProductDetail::class, 'nProductIdx', 'nIdx');
    }
    public function productMarketSetting()
    {
        return $this->belongsTo(MarketSettingCoupang::class, 'nMarketSetIdx', 'nIdx');
    }
    public function productRegCoupang()
    {
        return $this->hasMany(FailedProductRegCoupang::class, 'nProductIdx', 'nIdx');
    }
    public function productReg11thhouse()
    {
        return $this->hasMany(FailedProductReg11thhouse::class, 'nProductIdx', 'nIdx');
    }
    public function productRegAuction()
    {
        return $this->hasMany(FailedProductRegAuction::class, 'nProductIdx', 'nIdx');
    }
    public function productRegGmarket()
    {
        return $this->hasMany(FailedProductRegGmarket::class, 'nProductIdx', 'nIdx');
    }
    public function productRegInterpark()
    {
        return $this->hasMany(FailedProductRegInterpark::class, 'nProductIdx', 'nIdx');
    }
    public function productLotteon()
    {
        return $this->hasMany(FailedProductRegLotteon::class, 'nProductIdx', 'nIdx');
    }
    public function productSmartstore()
    {
        return $this->hasMany(FailedProductSmartstore::class, 'nProductIdx', 'nIdx');
    }
    public function productTmon()
    {
        return $this->hasMany(FailedProductRegTmon::class, 'nProductIdx', 'nIdx');
    }
    public function productWemakeprice()
    {
        return $this->hasMany(FailedProductWemakeprice::class, 'nProductIdx', 'nIdx');
    }
    public function productItems()
    {
        return $this->hasMany(FailedProductItem::class, 'nProductIdx', 'nIdx');
    }
}
