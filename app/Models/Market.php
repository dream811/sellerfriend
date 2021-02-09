<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;
    protected $table = 'tb_markets';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;

    public function marketAccounts()
    {
        return $this->hasMany(MarketAccount::class, 'nMarketIdx', 'nIdx');
    }
    public function useableMarketAccounts()
    {
        return $this->marketAccounts->where('bIsUsed', 1);
    }
}
