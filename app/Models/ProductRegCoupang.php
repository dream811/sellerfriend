<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRegCoupang extends Model
{
    use HasFactory;
    
    protected $table = 'tb_product_reg_coupang';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nProductIdx', 'nMarketAccIdx', 'nUserId', 'bIsDel'];
}
