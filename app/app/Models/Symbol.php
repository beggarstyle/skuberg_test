<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    use HasFactory;

    protected $table = 'symbols';

    protected $fillable = [
        'info',
        'symbol',
        'ordering',
    ];

    public function wallets()
    {
        return $this->hasOne(Wallet::class, 'symbol', 'symbol');
    }
}
