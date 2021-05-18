<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'tb_order_items';
    protected $primaryKey = 'nIdx';
    protected $fillable = [
        'nOrderIdx',
        'nProductItemIdx',
        'strVendorItemPackageId', 
        'strVendorItemPackageName', 
        'strProductId', 
        'strVendorItemId', 
        'strVendorItemName', 
        'strImageUrl',
        'nShippingCount', 
        'nSalesPrice', 
        'nOrderPrice', 
        'nDiscountPrice', 
        'nInstantCouponDiscount', 
        'nDownloadableCouponDiscount', 
        'nCoupangDiscount', 
        'strExternalVendorSkuCode', 
        'strEtcInfoHeader', 
        'strEtcInfoValue', 
        'strEtcInfoValues', 
        'strSellerProductId', 
        'strSellerProductName', 
        'strFirstSellerProductItemName', 
        'nHoldCountForCancel', 
        'dtEstimatedShippingDate', 
        'dtPlannedShippingDate', 
        'dtInvoiceNumberUploadDate', 
        'strExtraProperties', 
        'bPricingBadge', 
        'bUsedProduct', 
        'dtConfirmDate', 
        'strDeliveryChargeTypeName', 
        'bCanceled', 
        'nWorkProcess', //수동매칭
        'nRequestType', //구매타입
        'created_at', 'updated_at', 'bIsDel'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'nOrderIdx', 'nIdx');
    }
}
