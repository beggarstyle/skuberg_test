<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Fiat;
use App\Models\Symbol;
use App\Models\Market;
use App\Models\Wallet;

class MarketController extends Controller
{
    public function create()
    {
        $symbols = Symbol::where('status', 1)->get();
        $fiats = Fiat::all();

        return view('market.create', compact('symbols', 'fiats'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $symbol = Symbol::select('id')
            ->where('symbol', $request->asset)
            ->first();

        $fiat = Fiat::select('id')
            ->where('symbol', $request->fiat)
            ->first();

        $typeId = $request->type === 'buy' ? 1 : 2;

        $create = Market::create([
            'user_id' => $userId,
            'type' => $typeId,
            'asset_id' => $symbol->id,
            'fiat_id' => $fiat->id,
            'price' => $request->price,
            'amount' => $request->amount,
            'status' => 1,
        ]);

        $updateWallet = Wallet::where('user_id', $userId)
            ->where('symbol', $request->asset)
            ->decrement('available', $request->amount);

        return redirect()->to('/market/board?type=buy&symbols=BTC&fiats=THB');
    }

    public function board(Request $request)
    {
        $symbols = Symbol::where('status', 1)->get();
        $fiats = Fiat::all();

        $typeId = 2;
        $assetId = 1;
        $fiatId = 1;

        $orderBy = ($request->type === 'buy') ? 'asc' : 'desc';

        if ($request->has('type')) {
            $typeId = $request->type === 'buy' ? 2 : 1;
        }

        if ($request->has('symbols')) {
            $assetId = Symbol::select('id')
                ->where('symbol', $request->symbols)
                ->where('status', 1)
                ->first()
                ->id;
        }

        if ($request->has('fiats')) {
            $fiatId = Fiat::select('id')
                ->where('symbol', $request->fiats)
                ->first()
                ->id;
        }

        $market = Market::where('type', $typeId)
            ->where('asset_id', $assetId)
            ->where('fiat_id', $fiatId)
            ->where('amount', '>', 0)
            ->with('user')
            ->orderBy('price', $orderBy)
            ->get();

        return view('market.board', compact('symbols', 'fiats', 'market'));
    }

    public function sell()
    {
        return view('market.sell');
    }
}
