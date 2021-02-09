<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'tb_categories';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nParentIdx', 'nCatetoryType', 'strCategoryName', 'bIsDel'];
}
