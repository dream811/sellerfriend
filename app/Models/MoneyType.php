<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyType extends Model
{
    use HasFactory;
    protected $table = 'tb_money_types';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['strMoneyCode', 'strMoneyName', 'bIsDel'];
}
