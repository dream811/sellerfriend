<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedProductImage extends Model
{
    use HasFactory;
    protected $table = 'tb_failed_product_images';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nIdx', 'nProductIdx', 'nImageCode', 'strName', 'strURL', 'nHeight', 'nWidth', 'strNote', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(FailedProduct::class, 'nProductIdx', 'nIdx');
    }
}
