<x-Layouts.Market>
  <div class="w-full h-min flex flex-col">
    <div class="w-full h-full flex justify-between shadow-xl bg-white p-4 mb-4">
      <div>
        New Trading
      </div>
    </div>

    <div class="w-full bg-white mb-4">
      <form action="{{ route('market.store') }}" method="post" class="px-4 py-2">
        {{ csrf_field() }}

        <div class="mb-4">
          <label for="">Type</label>
          <div>
            <input type="radio" name="type" value="buy" checked /> Buy
            <input type="radio" name="type" value="sell" /> Sell
          </div>
        </div>

        <div class="mb-4">
          <label for="">Asset</label>
          <div>
            @foreach($symbols as $index => $symbol)
              <input
                type="radio"
                name="asset"
                value="{{ $symbol->symbol }}"
                {{ $index < 1 ? 'checked' : '' }}
              /> {{ $symbol->symbol }}
            @endforeach
          </div>
        </div>

        <div class="mb-4">
          <label for="">With Cash</label>
          <div>
            @foreach($fiats as $index => $fiat)
              <input
              type="radio"
              name="fiat"
              value="{{ $fiat->symbol }}"
              {{ $index < 1 ? 'checked' : '' }}
            /> {{ $fiat->symbol }}
            @endforeach
          </div>
        </div>

        <div class="flex flex-col mb-4">
          <label for="">Total Price</label>
          <input type="text" class="border border-gray-400 rounded-md h-10" name="price" />
        </div>

        <div class="flex flex-col mb-4">
          <label for="">Total Amount</label>
          <input type="text" class="border border-gray-400 rounded-md h-10" name="amount" />
        </div>

        <div class="mb-4">
          <button type="submit" class="bg-green-400 p-2">Submit</button>
        </div>
      </form>
    </div>
  </div>
</x-Layouts.Market>

