<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketSettingCoupang extends Model
{
    use HasFactory;
    protected $table = 'tb_market_user_setting_coupang';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['nMarketIdx', 'nUserId', 'nMarketAccIdx', 'strTitle', 'nSupportOption', 'nVersion', 'nSalesAgentRate', 'dtSalesPeriodStartDateTime', 'dtSalesPeriodEndDateTime', 'nUnitQuantity', 'nMaxQtyPerManDayLimit', 'nMaxQtyPerManQtyLimit', 'bParallelImport',
                            'bOverSeaPurchaseAgent', 'bOnlyAdult', 'nImageProcessType', 'nDeliveryType', 'nPersonPassingCodeType', 'strUnionDeliveryType', 'nUnionDeliveryQty', 'nRemoteAreaDeliveryType', 'nOutboundShippingTimeDay', 'strOutboundShippingPlaceCode', 'strDeliveryCompanyCode',
                            'strDeliveryChargeType', 'nDeliveryCharge', 'nFreeShipOverAmount', 'nDeliveryChargeOnReturn', 'nReturnDeliveryCharge', 'nJejuDeliveryCharge', 'nNotJejuDeliveryCharge', 'strReturnCenterCode', 'strReturnSellerName', 'strCompanyContactNumber', 'strReturnZipCode', 
                            'strReturnAddress', 'strReturnAddressDetail', 'strExchangeType', 'strReturnChargeVendorType', 'strAfterServiceGuideType', 'strAfterServiceGuide', 'strAfterServiceContactNumber', 'nRequireDocument1', 'nRequireDocument2', 'nRequireDocument3', 'nRequireDocument4', 'nRequireDocument5', 'nRequireDocument6',
                            'nTopImageIdx', 'nDownImageIdx', 'created_at', 'updated_at', 'bIsUsed', 'bIsDel'
                        ];
    
    public function marketAccount()
    {
        return $this->belongsTo(MarketAccount::class, 'nMarketAccIdx', 'nIdx');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'nMarketIdx', 'nIdx');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nUserId', 'id');
    }

    public function topImage()
    {
        return $this->belongsTo(DocumentImage::class, 'nTopImageIdx', 'nIdx');
    }

    public function downImage()
    {
        return $this->belongsTo(DocumentImage::class, 'nDownImageIdx', 'nIdx');
    }
    public function requireDocument1()
    {
        return $this->belongsTo(DocumentImage::class, 'nRequireDocument1', 'nIdx');
    }

    public function requireDocument2()
    {
        return $this->belongsTo(DocumentImage::class, 'nRequireDocument2', 'nIdx');
    }

    public function requireDocument3()
    {
        return $this->belongsTo(DocumentImage::class, 'nRequireDocument3', 'nIdx');
    }

    public function requireDocument4()
    {
        return $this->belongsTo(DocumentImage::class, 'nRequireDocument4', 'nIdx');
    }

    public function requireDocument5()
    {
        return $this->belongsTo(DocumentImage::class, 'nRequireDocument5', 'nIdx');
    }

    public function requireDocument6()
    {
        return $this->belongsTo(DocumentImage::class, 'nRequireDocument6', 'nIdx');
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class, 'nDeliveryType', 'nIdx');
    }

    public function deliveryType1()
    {
        return $this->belongsTo(DeliveryType::class, 'nDeliveryType', 'nIdx');
    }
}
