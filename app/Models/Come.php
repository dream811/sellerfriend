<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Come extends Model
{
    use HasFactory;
    protected $table = 'tb_comes';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strComeCode', 'strComeName', 'bIsDel'];
    
}
