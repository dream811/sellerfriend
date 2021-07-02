<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tb_products';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['strId', 'strSolutionId', 'strURL', 'strMainName', 'strSubName', 'nUserId', 'nBrandType', 'strBrand', 'strKeyword', 'strKoOption', 'strKoOptionValue', 
    'strCnOption', 'strCnOptionValue', 'strOptionPrice', 'blobOptionImage', 'strChMainName', 'strKrMainName', 'strChSubName', 'strKrSubName', 'strComeCode', 'strCategoryCode0', 'strCategoryCode1', 
    'strCategoryCode2', 'strCategoryCode3', 'strCategoryCode4', 'strCategoryCode5', 'strCategoryCode6', 'strCategoryCode7', 'strCategoryCode8', 'nShareType', 'nProductWorkProcess', 
    'bReg11thhouse', 'bRegAuction', 'bRegCoupang', 'bRegGmarket', 'bRegInterpark', 'bRegLotteon', 'bRegSmartstore', 'bRegTmon', 'bRegWemakeprice', 'strReason', 
    'created_at', 'updated_at', 'bIsDel'];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx');
    }
    
    public function productMainImage()
    {
        //return $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx')->where('nImageCode', 0);

        $instance = $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx')->where('nImageCode','=', 0);
        //$instance->getQuery()->where('nImageCode','=', 0)->take(1);
        return $instance;
    }
    // public function productSubImage1()
    // {
    //     return $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx')->where('nImageCode', 1)->first();
    // }
    // public function productSubImage2()
    // {
    //     return $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx')->where('nImageCode', 2)->first();
    // }

    // public function options()
    // {
    //     return $this->hasMany(SuccessProductOption::class, 'nProductIdx', 'nIdx');
    // }

    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'nProductIdx', 'nIdx');
    }

    public function productOptions()
    {
        return $this->hasOne(ProductOption::class, 'nProductIdx', 'nIdx');
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
        return $this->hasMany(ProductSmartstore::class, 'nProductIdx', 'nIdx');
    }
    public function productTmon()
    {
        return $this->hasMany(ProductRegTmon::class, 'nProductIdx', 'nIdx');
    }
    public function productWemakeprice()
    {
        return $this->hasMany(ProductWemakeprice::class, 'nProductIdx', 'nIdx');
    }
    public function productItems()
    {
        return $this->hasMany(ProductItem::class, 'nProductIdx', 'nIdx');
    }
}
