<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category11thNormal extends Model
{
    use HasFactory;
    
    protected $table = 'tb_categories_11thnormal';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strCateCode', 'strCategoryName', 'bIsDel'];
}
