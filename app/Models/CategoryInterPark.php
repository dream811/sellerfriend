<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryInterPark extends Model
{
    use HasFactory;
    
    protected $table = 'tb_categories_interpark';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strCateCode', 'strCategoryName', 'bIsDel'];
}
