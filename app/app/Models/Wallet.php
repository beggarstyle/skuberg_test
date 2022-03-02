<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'symbol',
        'address',
        'available',
        'actual',
    ];

    // public function wallet()
    // {
    //     return $this->belongsTo('App\Models\Departamento', 'department_id');
    // }
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function withdraw($params)
    {
        # code...
    }

    public function findOrCreateWalletBySymbol($params)
    {
        $wallet = Wallet::select('*')
            ->where('user_id', $params['userId'])
            ->where('symbol', $params['symbol'])
            ->get();
            // ->first();

        if ($wallet->isEmpty()):
            return Wallet::create([
                'user_id' => $params['userId'],
                'symbol' => $params['symbol'],
                'address' => (string) Str::uuid(),
                'available' => 0,
                'actual' => 0,
            ]);
        endif;

        return $wallet->first();
    }

    public function updateWalletBySymbol($params)
    {
        // $amount = $params['amount']
        // $userId = $params['userId']
        // $symbol = $params['symbol']

        $wallet = Wallet::select('available', 'actual')
            ->where('user_id', $params['userId'])
            ->where('symbol', $params['symbol'])
            ->first();

        // dd($wallet);
        // $updateWallet = Wallet::where('user_id', $params['userId'])
        //     ->where('symbol', $params['symbol'])
        //     ->update([
        //         'available' => $wallet->amount - $params['amount'],
        //         'actual' => $wallet->actual - $params['amount']
        //     ]);
    }


    public static function getPriceByPrice($params)
    {
        $min = $max = 0;

        if ($params['symbol'] == 2):
            $min = 1448500;
            $max = 1500000;
        endif;

        if ($params['symbol'] == 3):
            $min = 98000;
            $max = 0;
        endif;

        if ($params['symbol'] == 4):
            $min = 26;
            $max = 25;
        endif;

        if ($params['symbol'] == 5):
            $min = 4;
            $max = 5;
        endif;

        return rand($min, $max);
    }
}
