<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    use HasFactory;
    protected $table = 'tb_delivery_types';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['nMarketIdx', 'strDeliveryCode', 'strDeliveryName', 'created_at', 'updated_at', 'bIsDel'];
    
    public function market()
    {
        return $this->belongsTo(Market::class, 'nMarketIdx', 'nIdx');
    }
}
