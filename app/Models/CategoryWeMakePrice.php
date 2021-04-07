<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryWeMakePrice extends Model
{
    use HasFactory;
    
    protected $table = 'tb_categories_wemakeprice';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strCateCode', 'strCategoryName', 'bIsDel'];
}
