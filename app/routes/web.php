<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Symbol;
use App\Models\Wallet;
use App\Models\Market;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::middleware(['auth', 'auth.basic'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');

    Route::get('/market/board', [MarketController::class, 'board'])->name('market.board');
    Route::get('/market/order', [MarketController::class, 'order'])->name('market.order');
    Route::get('/market/create', [MarketController::class, 'create'])->name('market.create');
    Route::post('/market/create', [MarketController::class, 'store'])->name('market.store');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{type}/{id}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/{type}/{id}', [OrderController::class, 'store'])->name('order.store');
});

Route::get('/test', function() {
    // $wallet = Market::where('id', 89)
    //     ->decrement('amount', 1);
    // $wallet = Wallet::where('user_id', 1)
    //     ->where('symbol', 'DOGE')
    //     ->increment('available', 5, [
    //         'actual' => 5
    //     ]);

    //     dd($wallet);
    // $symbols = Symbol::select('id', 'symbol')->where('status', 1)->get()->toArray();
    // $random = array_rand($symbols, 1);
    // $symbol = $symbols[$random]['id'];
    // // dd($symbol);

    // dd(Wallet::getPriceByPrice(['symbol' => $symbol]));
    // $digits = 3;
    // dd(mt_rand(10 * 10, 20 * 10));

    // $updateWallet = Wallet::where('user_id', 1)
    //     ->where('symbol', 'THB')
    //     ->update([
    //         'available' => 1000,
    //         'actual' => 1000
    //     ]);
    // exit;

    $amount = 31.06;

    // $wallet = Wallet::findOrCreateWalletBySymbol([
    //     'userId' => 1,
    //     'symbol' => 'DOGE'
    // ]);

    // dd($wallet);
    // Buy
    // $wallet = Wallet::select('available', 'actual')
    //     ->where('user_id', 1)
    //     ->where('symbol', 'THB')
    //     ->increment('available', 1000);

    // $wallet = Wallet::increment('available', 1000, [
    //     'user_id' => 1,
    //     'symbol' => 'THB'
    // ]);

    // $wallet = Wallet::increment('actual', 1000, [
    //     'user_id' => 1,
    //     'symbol' => 'THB'
    // ]);

        // ->first();

    // Wallet::where('user_id', 1)
    //     ->where('symbol', 'THB')
    //     ->increment('available', 1000)
    //     ->increment('actual', 1000);

    // $updateWallet = Wallet::where('user_id', 1)
    //     ->where('symbol', 'THB')
    //     ->update([
    //         'available' => $wallet->amount - $amount,
    //         'actual' => $wallet->actual - $amount
    //     ]);

    // // Seller
    // $updateMarketAvaliable = Market::updateAvaliableByMarketId([
    //     'marketId' => 69,
    //     'userId' => 94,
    //     'amount' => $amount,
    // ]);

    // $updateWallet = Wallet::updateWalletBySymbol([
    //     'userId' => 94,
    //     'symbol' => 'XRP',
    //     'amount' => $amount,
    // ]);

    // $wallet = Wallet::select('available', 'actual')
    //     ->where('user_id', 1)
    //     ->where('symbol', 'THB')
    //     ->first();

    // $updateWallet = Wallet::where('user_id', 1)
    //     ->where('symbol', 'THB')
    //     ->update([
    //         'available' => $wallet->amount - $amount,
    //         'actual' => $wallet->actual - $amount
    //     ]);

    // dd($toSql);
    // dd(pow(10, $digits-1));
    // $c = rand(pow(10, $digits-1), pow(10, $digits)-1);
    // dd($c);
});

Route::get('/migrate', function () {
    // Wallet::create([
    //     'user_id' => 1,
    //     'symbol' => 'BTC',
    //     'address' => (string) Str::uuid(),
    //     'available' => 10,
    //     'actual' => 10,
    // ]);
    // return (string) Str::uuid();
    // $users = User::with('wallet')->first()->toArray();
    // dd($users);

    // return view('login');

    // dd(Symbols::all());
    // $symbols = Symbol::all();

    $symbols = Symbol::select('symbol')
        ->where('status', 1)
        ->get()
        ->toArray();

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

    // foreach($users as $index => $user):
    //     dd($index, $user);
        // $created = User::create([
        //     'name' => 'Seller_',
        //     'email' => 'seller_@gmail.com',
        //     'password' => Hash::make($request->password),
        // ]);

    //     // Symbols::all()
    //     // dd($symbol->id);
    //     $updated = Symbol::where('id', $symbol->id)
    //         ->update(['info' => str_replace('Thai Baht to ', '', $symbol->info)]);
    //         // ->update(['symbol' => str_replace('THB_', '', $symbol->symbol)]);

    //     // $created = Symbol::find([
    // //         'info' => $symbol['info'],
    // //         'symbol' => $symbol['symbol'],
    // //     ]);
    // //     var_dump($created);
    // endforeach;
});
