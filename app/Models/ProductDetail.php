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
    protected $fillable = ['nIdx', 'nProductIdx', 'nProductPrice', 'nBasePrice', 'nDiscountPrice', 
    'nExchangeRate', 'nExpectedRevenue', 'nMarginRate', 'nSellerMarketChargeRate', 'nBuyerMarketChargeRate', 'nOverSeaDeliveryCharge', 
    'strFunction', 'nDeliveryCharge', 'nReturnDeliveryCharge', 'nExchangeDeliveryCharge', 'nOptionSellPrice', 'nOptionBasePrice', 
    'nOptionDiscountPrice', 'nOptionSSPrice', 'nOptionESMPrice', 'nOptionSellDiscountPrice', 'nOptionESMDeliveryCharge', 'blobNote', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'nProductIdx', 'nIdx');
    }
}
