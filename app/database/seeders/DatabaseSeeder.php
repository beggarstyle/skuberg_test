<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Symbol;
use App\Models\Fiat;
use App\Models\Wallet;
use App\Models\Market;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $createFint = [
            ['symbol' => 'THB','ordering' => 1],
            ['symbol' => 'USD','ordering' => 2]
        ];
        foreach($createFint as $symbol):
            // dd($symbol);
            Fiat::create([
                'symbol' => $symbol['symbol'],
                'ordering' => $symbol['ordering']
            ]);
        endforeach;

        $createSymbols = [
            ['info' => 'Thai Baht', 'symbol' => 'THB', 'ordering' => 1, 'status' => 0],
            ['info' => 'Bitcoin', 'symbol' => 'BTC', 'ordering' => 2, 'status' => 1],
            ['info' => 'Ethereum', 'symbol' => 'ETH', 'ordering' => 3, 'status' => 1],
            ['info' => 'XRP', 'symbol' => 'XRP', 'ordering' => 4, 'status' => 1],
            ['info' => 'Dogecoin', 'symbol' => 'DOGE', 'ordering' => 5, 'status' => 1]
        ];

        foreach($createSymbols as $fint):
            Symbol::create([
                'info' => $fint['info'],
                'symbol' => $fint['symbol'],
                'ordering' => $fint['ordering'],
                'status' => $fint['status']
            ]);
        endforeach;

        $symbols = Symbol::select('symbol')
            ->where('status', 1)
            ->get()
            ->toArray();

        // Test
        $created = User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('123456'),
        ]);

        $wallet = Wallet::create([
            'user_id' => $created->id,
            'symbol' => 'THB',
            'address' => (string) Str::uuid(),
            'available' => 10000,
            'actual' => 10000,
        ]);

        for ($i=1; $i <= 25; $i++) {
            $typeId = rand(1, 2);

            $name = $typeId === 1 ? 'Buyer' : 'Seller';

            $user = [
                'name' => "{$name}_{$i}",
                'email' => "{$name}_{$i}@gmail.com",
                'password' => Hash::make('123456'),
            ];

            $created = User::create($user);

            $random = array_rand($symbols, 1);
            $symbol = $symbols[$random]['symbol'];

            $symbolId = Symbol::select('id')
                ->where('symbol', $symbol)
                ->first()
                ->id;

            $amount = rand(10, 100);
            $fiatId = 1;

            $wallet = Wallet::create([
                'user_id' => $created->id,
                'symbol' => $symbol,
                'address' => (string) Str::uuid(),
                'available' => $amount,
                'actual' => $amount,
            ]);

            $marketAmount = rand(10, 80);

            $createMarketPlace = Market::create([
                'user_id' => $created->id,
                'type' => $typeId,
                'asset_id' => $symbolId,
                'fiat_id' => 1,
                'price' => Wallet::getPriceByPrice(['symbol' => $symbolId]),
                'amount' => $marketAmount,
                'status' => 1,
            ]);

            // Update Wallet Available
            $updateAvailable = Wallet::where('user_id', $created->id)
                ->where('symbol', $symbol)
                ->update(['available' => $amount - $marketAmount]);
        }
    }
}
