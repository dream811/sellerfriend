<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedProductItem extends Model
{
    use HasFactory;
    protected $table = 'tb_failed_product_items';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nIdx', 'nProductIdx', 'nProductOptIdx0', 'nProductOptIdx1', 'nProductOptIdx2', 'strSubItemName', 'nSubItemOptionPrice', 
    'nSubItemBasePrice', 'nSubItemSellPrice', 'nSubItemDiscountPrice', 'nSubItemWeight', 'nSubItemQuantity', 'strSubItemImage', 'strSubItemKoOptionPattern0', 
    'strSubItemKoOptionPattern1', 'strSubItemKoOptionPattern2', 'strSubItemCnOptionPattern0', 'strSubItemCnOptionPattern1', 'strSubItemCnOptionPattern2', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(FailedProduct::class, 'nProductIdx', 'nIdx');
    }
    
    
}
