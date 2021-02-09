<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tb_products';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['strId', 'strURL', 'strMainName', 'strSubName', 'nUserId', 'nBrandType', 'strBrand', 'strKeyword', 'strChMainName', 'strKrMainName', 'strChSubName', 'strKrSubName', 'nComeCode', 'nCategoryCode1', 'nCategoryCode2', 'nCategoryCode3', 'nCategoryCode4', 'strCategoryName', 'nShareType', 'nProductWorkProcess', 'created_at', 'updated_at', 'bIsDel'];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'nProductIdx', 'nIdx');
    }
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'nProductIdx', 'nIdx');
    }
    public function productItems()
    {
        return $this->hasMany(ProductItem::class, 'nProductIdx', 'nIdx');
    }
}
