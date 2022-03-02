<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Payments;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $orders = Order::where(function($query) use ($userId) {
            $query->where('buyer_id', $userId)
                ->orWhere('seller_id', $userId);
        })
        ->with('market')
        ->get();

        return view('order.index', compact('orders'));
    }

    public function create(Request $request, $type, $id)
    {
        $market = Market::with(['user', 'symbol', 'fiat'])
            ->find($id);

        $wallets = Auth::user()->wallets()->get();

        return view('order.create', compact('market', 'wallets', 'type'));
    }

    public function store(Request $request, $type, $id)
    {
        // dd($request->all(), $id);

        // DB::beginTransaction();

        // try {
            $userId = Auth::id();

            // $buyerId = $request->type == 2 ? $userId : $request->sell_id;
            // $sellerId = $request->type == 1 ? $userId : $request->sell_id;

            $buyerId = $type === 'buy' ? $userId : $request->sell_id;
            $sellerId = $type !== 'buy' ? $userId : $request->sell_id;

            $ordered = Order::create([
                'market_id' => $id,
                'type' => $request->type,
                'buyer_id' => $buyerId,
                'seller_id' => $sellerId,
                'amount' => $request->amount,
                'receive' => $request->receive,
                'status' => 1,
            ]);

            /**
             * Update User
             */

            // dd([
            // 'buyerId' => $buyerId,
            // 'sellerId' => $sellerId,
            // 'amount' => $request->amount,
            // 'fiat' => 'THB'
            // ], [
            // 'buyerId' => $buyerId,
            // 'sellerId' => $sellerId,
            // 'receive' => $request->receive,
            // 'symbol' => $request->symbol
            // ]);

            Payments::transferFiat([
                'buyerId' => $buyerId,
                'sellerId' => $sellerId,
                'amount' => $request->amount,
                'fiat' => 'THB'
            ]);

            Payments::transferSymbol([
                'buyerId' => $buyerId,
                'sellerId' => $sellerId,
                'receive' => $request->receive,
                'symbol' => $request->symbol
            ]);

            $updateMarketAmount = Market::where('id', $id)
                ->decrement('amount', $request->receive);

        //     DB::commit();
        // } catch (\Exception $exp) {
        //     DB::rollBack();

        //     dd($exp->getMessage());
        // }

        // return redirect('/');
        return redirect()->to("/market/board?type={$type}&symbols={$request->symbol}&fiats=THB");

    }
}
