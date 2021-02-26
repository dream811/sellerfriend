<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightType extends Model
{
    use HasFactory;
    protected $table = 'tb_weight_types';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strWeightCode', 'strWeightName', 'bIsDel'];
}
