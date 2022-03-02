<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Symbol;

class WalletController extends Controller
{
    public function index()
    {
        // $symbols = Symbol::orderBy('ordering', 'asc')->get();

        $userId = Auth::id();

        $symbols = Symbol::select([
            'symbols.info', 'symbols.symbol', 'symbols.ordering',
            'wallets.available', 'wallets.actual'
        ])
        ->leftJoin('wallets', function ($leftJoin) use ($userId) {
            $leftJoin->on('symbols.symbol', '=', 'wallets.symbol')
                ->where('wallets.user_id', $userId);
        })
        ->orderBy('ordering', 'asc')
        ->get();

        return view('wallet', compact('symbols'));
    }

    public function deposit(Request $request)
    {
        return view('deposit');
    }

    public function withdraw(Request $request)
    {
        return view('withdraw');
    }
}
