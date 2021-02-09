<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    use HasFactory;
    protected $table = 'tb_delivery_companies';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['nMarketIdx', 'strCompanyCode', 'strCompanyName', 'created_at', 'updated_at', 'bIsDel'];
    
    public function market()
    {
        return $this->belongsTo(Market::class, 'nMarketIdx', 'nIdx');
    }
}
