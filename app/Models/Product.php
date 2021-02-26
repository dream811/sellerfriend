<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tb_products';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['strId', 'strURL', 'strMainName', 'strSubName', 'nUserId', 'nBrandType', 'strBrand', 'strKeyword', 'strChMainName', 'strKrMainName', 'strChSubName', 'strKrSubName', 'strComeCode', 'strCategoryCode1', 'strCategoryCode2', 'strCategoryCode3', 'strCategoryCode4', 'strCategoryName', 'nShareType', 'nProductWorkProcess', 
    'bReg11thhouse', 'bRegAuction', 'bRegCoupang', 'bRegGmarket', 'bRegInterpark', 'bRegLotteon', 'bRegSmartstore', 'bRegTmon', 'bRegWemakeprice', 'created_at', 'updated_at', 'bIsDel'];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx');
    }
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'nProductIdx', 'nIdx');
    }
    public function productRegCoupang()
    {
        return $this->hasMany(ProductRegCoupang::class, 'nProductIdx', 'nIdx');
    }
    public function productReg11thhouse()
    {
        return $this->hasMany(ProductReg11thhouse::class, 'nProductIdx', 'nIdx');
    }
    public function productRegAuction()
    {
        return $this->hasMany(ProductRegAuction::class, 'nProductIdx', 'nIdx');
    }
    public function productRegGmarket()
    {
        return $this->hasMany(ProductRegGmarket::class, 'nProductIdx', 'nIdx');
    }
    public function productRegInterpark()
    {
        return $this->hasMany(ProductRegInterpark::class, 'nProductIdx', 'nIdx');
    }
    public function productLotteon()
    {
        return $this->hasMany(ProductRegLotteon::class, 'nProductIdx', 'nIdx');
    }
    public function productSmartstore()
    {
        return $this->hasMany(productSmartstore::class, 'nProductIdx', 'nIdx');
    }
    public function productTmon()
    {
        return $this->hasMany(ProductRegTmon::class, 'nProductIdx', 'nIdx');
    }
    public function productWemakeprice()
    {
        return $this->hasMany(productWemakeprice::class, 'nProductIdx', 'nIdx');
    }
    public function productItems()
    {
        return $this->hasMany(ProductItem::class, 'nProductIdx', 'nIdx');
    }
}
