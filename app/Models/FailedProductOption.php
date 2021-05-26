<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;
    protected $table = 'tb_product_options';
    protected $primaryKey = 'nIdx';
    protected $fillable = ['nProductIdx', 'nOptionKey', 'strKoOptionName', 'strKoOptionValue', 'strCnOptionName', 'strCnOptionValue', 'nOptionPrice', 'strImageURL', 'created_at', 'updated_at', 'bIsDel'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'nProductIdx', 'nIdx');
    }
}
