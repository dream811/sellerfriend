<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_product_details';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nIdx', 'nProductIdx', 'nBasePriceType', 'nBasePrice', 'nCountryShippingCostType', 'nCountryShippingCost', 'nWorldShippingCostType', 'nWorldShippingCost', 'nWeightType', 'nWeight', 'bAdditionalOption1', 'bAdditionalOption2', 'bAdditionalOption3', 'bAdditionalOption4', 'nMultiPriceOptionType', 'blobNote', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'nProductIdx', 'nIdx');
    }
}
