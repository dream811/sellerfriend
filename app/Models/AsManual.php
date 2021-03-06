<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsManual extends Model
{
    use HasFactory;
    protected $table = 'tb_as_manuals';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strAsCode', 'strAsContent', 'bIsDel'];
}
