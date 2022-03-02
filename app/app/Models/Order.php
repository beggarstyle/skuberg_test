<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Market;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_id',
        'type',
        'buyer_id',
        'seller_id',
        'amount',
        'receive',
        'status'
    ];

    public function markets()
    {
        return $this->hasMany(Market::class, 'id', 'market_id');
        // belongsTo
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
}
