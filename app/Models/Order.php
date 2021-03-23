<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'tb_orders';
    protected $primaryKey = 'nIdx';
    protected $fillable = [
        'strShipmentBoxId',
        'strOrderId',
        'dtOrderAt',
        'strOrdererName',
        'strOrdererEmail',
        'strOrdererSafeNumber',
        'strOrdererNumber',
        'dtPaidAt',
        'strStatus',
        'nShippingPrice',
        'nRemotePrice',
        'bRemoteArea',
        'strParcelPrintMessage',
        'bSplitShipping',
        'bAbleSplitShipping',
        'strReceiverName',
        'strReceiverSafeNumber',
        'strReceiverNumber',
        'strReceiverAddr1',
        'strReceiverAddr2',
        'strPostCode',
        'strOSIDPersonalCustomClearanceCode',
        'strOSIDOrdererSsn',
        'strOSIDOrdererPhoneNumber',
        'strDeliveryCompanyName',
        'dtInTrasitDateTime',
        'dtDeliveredDate',
        'strReferer',
        'created_at', 'updated_at', 'bIsDel'
    ];
    
}
