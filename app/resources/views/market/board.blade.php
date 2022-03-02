<x-Layouts.Market>
  <div class="w-full h-min flex flex-col">
    <div class="w-full h-full flex justify-between shadow-xl bg-white p-4 mb-4">
      <form id="form" action="" class="w-2/5 flex justify-around">
        <div>
          <select class="p-1" name="type" onchange="onSubmit()">
            <option
              value="buy"
              {{ Request::get('type') === 'buy' ? 'selected' : '' }}
            >Buy</option>
            <option
              value="sell"
              {{ Request::get('type') === 'sell' ? 'selected' : '' }}
            >Sell</option>
          </select>
        </div>

        <div>
          <label class="mr-2">Symbols: </label>
          <select class="p-1" name="symbols" onchange="onSubmit()">
            @foreach($symbols as $symbol)
              <option
                value="{{ $symbol->symbol }}"
                {{ Request::get('symbols') === $symbol->symbol ? 'selected' : '' }}
              >{{ $symbol->symbol }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex flex-row">
          <label class="mr-2">Fiats: </label>
          <select class="p-1" name="fiats" onchange="onSubmit()">
            @foreach($fiats as $fiat)
              <option
                value="{{ $fiat->symbol }}"
                {{ Request::get('fiats') === $fiat->symbol ? 'selected' : '' }}
              >{{ $fiat->symbol }}</option>
            @endforeach
          </select>
        </div>
      </form>

      <div>
        <a href="{{ route('market.create') }}" class="bg-green-400 p-2">Create</a>
      </div>
    </div>

    <div class="w-full bg-white mb-4 p-4">
      <table class="w-full border">
        <thead class="leading-8">
          <tr class="border-b-2">
            <th class="text-center">Advertisers</th>
            <th class="text-center">Price</th>
            <th class="text-center">Limit/Available</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($market as $item)
            <tr class="h-12 border-b-2">
              <td>{{ $item->user->name }}</td>
              <td class="text-right" width="120">{{ $item->price }}</td>
              <td class="text-right" width="120">{{ $item->amount }}</td>
              <td class="text-center" width="140">
                @if (Request::get('type') === 'buy')
                  <a
                    href="{{ route('order.create', ['type' => Request::get('type'), 'id' => $item->id]) }}"
                    class="rounded-sm bg-green-400 py-1 px-4"
                  >
                    BUY
                  </a>
                @else

                  <a
                    href="{{ route('order.create', ['type' => Request::get('type'), 'id' => $item->id]) }}"
                    class="rounded-sm bg-red-400 py-1 px-4"
                  >
                    SELL
                  </a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <script>
      function onSubmit() {
        document.querySelector("#form").submit()
      }
    </script>
  </div>
</x-Layouts.Market>

