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
    protected $fillable = ['nIdx', 'nProductIdx', 'strSubItemName', 'nSubItemOptionPrice', 'nSubItemBasePrice', 'nSubItemSalePrice', 'nSubItemWeight', 'strSubItemImage', 'strSubItemChColorPattern', 'strSubItemKrColorPattern', 'strSubItemChSize', 'strSubItemKrSize', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'nProductIdx', 'nIdx');
    }
    
    
}
