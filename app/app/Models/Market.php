<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Symbol;
use App\Models\Fiat;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'asset_id',
        'fiat_id',
        'price',
        'amount',
        'status',
    ];

    public function creater()
    {
        return $this->hasOne(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function symbol()
    {
        return $this->hasOne(Symbol::class, 'id', 'asset_id');
    }

    public function fiat()
    {
        return $this->hasOne(Fiat::class, 'id', 'fiat_id');
    }

    public function updateAvaliableByMarketId($params)
    {
        $currentMarketAmount = Self::select('id', 'amount')
            ->where('id', $params['marketId'])
            ->where('user_id', $params['userId'])
            ->first();

        $updateMarketAmount = Self::where('id', $params['marketId'])
            ->where('user_id', $params['userId'])
            ->update([
                'amount' => $currentMarketAmount->amount - $params['amount']
            ]);
    }
}
