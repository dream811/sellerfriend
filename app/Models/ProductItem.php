<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;
    protected $table = 'tb_product_items';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nIdx', 'nProductIdx', 'strSubItemName', 'nSubItemOptionPrice', 'nSubItemBasePrice', 'nSubItemSellPrice', 'nSubItemDiscountPrice',
    'nSubItemWeight', 'nSubItemQuantity', 'strSubItemImage', 'strSubItemKoOptionPattern0', 'strSubItemKoOptionPattern1', 'strSubItemKoOptionPattern2', 
    'strSubItemCnOptionPattern0', 'strSubItemCnOptionPattern1', 'strSubItemCnOptionPattern2', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'nProductIdx', 'nIdx');
    }
    
    
}
