<?php

namespace App\Models;

class Payments
{
    public function deposit()
    {
        # code...
    }

    public function withdraw()
    {
        # code...
    }

    public function transfer()
    {
        # code...
    }

    public function transferFiat($params)
    {
        $buyerId = $params['buyerId'];
        $sellerId = $params['sellerId'];
        $amount = $params['amount'];
        $fiat = $params['fiat'];

        //
        /**
         * check Wallet Buyer and Seller
         */
        Wallet::findOrCreateWalletBySymbol([
            'userId' => $sellerId,
            'symbol' => $fiat
        ]);

        Wallet::findOrCreateWalletBySymbol([
            'userId' => $sellerId,
            'symbol' => $fiat
        ]);

        /**
         *  Update Wallet Buyer and Seller
         */
        // Buyer
        $updateBuyerWallet = Wallet::where('user_id', $buyerId)
            ->where('symbol', $fiat)
            ->decrement('available', $amount);

        $updateBuyerWallet = Wallet::where('user_id', $buyerId)
            ->where('symbol', $fiat)
            ->decrement('actual', $amount);

        // Seller
        $updateSellerWallet = Wallet::where('user_id', $sellerId)
            ->where('symbol', $fiat)
            ->increment('available', $amount);

        $updateSellerWallet = Wallet::where('user_id', $sellerId)
            ->where('symbol', $fiat)
            ->increment('actual', $amount);
    }

    public function transferSymbol($params)
    {
        $buyerId = $params['buyerId'];
        $sellerId = $params['sellerId'];
        $receive = $params['receive'];
        $symbol = $params['symbol'];
        // dd($params, $buyerId, $sellerId, $receive, $symbol);
        //
        /**
         * check Wallet Buyer and Seller
         */
        Wallet::findOrCreateWalletBySymbol([
            'userId' => $buyerId,
            'symbol' => $symbol
        ]);

        /**
         *  Update Wallet Buyer and Seller
         */
        // Buyer
        $updateBuyerWallet = Wallet::where('user_id', $buyerId)
            ->where('symbol', $symbol)
            ->increment('available', $receive);

        $updateBuyerWallet = Wallet::where('user_id', $buyerId)
            ->where('symbol', $symbol)
            ->increment('actual', $receive);

        // Seller
        $updateBuyerWallet = Wallet::where('user_id', $sellerId)
            ->where('symbol', $symbol)
            ->decrement('available', $receive);

        $updateBuyerWallet = Wallet::where('user_id', $sellerId)
            ->where('symbol', $symbol)
            ->decrement('actual', $receive);
    }
}
