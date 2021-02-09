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
                            'bOverSeaPurchaseAgent', 'bOnlyAdult', 'nImageProcessType', 'nDeliveryType', 'nPersonPassingCodeType', 'strUnionDeliveryType', 'nCountrysideDeliveryType', 'nOutboundDeliveryTime', 'nOutboundShippingPlaceCode', 'nDeliveryCompanyCode',
                            'nDeliveryTaxType', 'nBaseDeliveryTax', 'nConditionFreeTax', 'nReturnAwayDeliveryTax', 'nDeliveryJejuAddTax', 'nDeliveryNotJejuTax', 'nReturnCenterCode', 'strReturnSellerName', 'strCompanyContactNumber', 'strReturnZipCode', 
                            'strReturnAddress', 'strReturnAddressDetail', 'nExchangeType', 'nReturnChargeVendorType', 'nAterServiceGuideType', 'strAfterServiceGuide', 'strAfterServiceContactNumber', 'nRequireDocument1', 'nRequireDocument2', 'nRequireDocument3', 'nRequireDocument4', 'nRequireDocument5', 'nRequireDocument6',
                            'nTopImage', 'nDownImage', 'created_at', 'updated_at', 'bIsDel'
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

}
