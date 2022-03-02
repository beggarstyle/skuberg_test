<x-Layouts.Market>
  <div class="w-full h-min flex flex-col">
    <div class="w-full h-full flex justify-between shadow-xl bg-white p-4 mb-4">
      <h2>Order</h2>
      <a href="#">Back</a>
    </div>

    <div class="w-full flex flex-row bg-white mb-4 p-4">
      <div class="w-1/2">
        <h2 class="mb-4">{{ $market->user->name }}</h2>

        <div class="flex">
          <!-- Left -->
          <div class="w-1/2">
            <div class="flex flex-row">
              <p class="mr-4">Symbol: </p>
              <p>{{ $market->symbol->symbol }}</p>
            </div>

            <div class="flex flex-row">
              <p class="mr-4">Price: </p>
              <p>{{ $market->price }}</p>
              <input type="hidden" id="price" value="{{ $market->price }}" />
              {{-- <input type="text" id="price" value="32.20" /> --}}

            </div>
          </div>

          <!-- Right -->
          <div class="w-1/2">
            <div class="flex flex-row">
              <p class="mr-4">Fiat: </p>
              <p>{{ $market->fiat->symbol }}</p>
            </div>

            <div class="flex flex-row">
              <p class="mr-4">Available: </p>
              <p>{{ $market->amount }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="w-1/2">
        <form
          action="{{ route('order.store', ['type' => $type, 'id' => $market->id]) }}"
          method="post"
          class="w-full border border-gray-400 rounded-lg p-4"
        >
          {{ csrf_field() }}
          <div class="flex flex-col mb-2">
            <label for="">I want to {{ $market->type === 1 ? 'sell' : 'buy' }}</label>
            <input
              type="text"
              id="amount"
              class="border border-gray-400 rounded-md h-10 p-1"
              name="amount"
              maxlength=""
              onchange="calAmount()"
            />
          </div>

          <div class="flex flex-col mb-4">
            <label for="">I will receive</label>
            <input
              type="text"
              id="receive"
              class="border border-gray-400 rounded-md h-10 p-1"
              name="receive"
              maxlength="{{ $market->amount }}"
              onchange="calReceive()"
            />

            <input type="hidden" name="symbol"  value="{{ $market->symbol->symbol }}" />
            <input type="hidden" name="type"  value="{{ $market->type }}" />
            <input type="hidden" name="sell_id" value="{{ $market->user_id }}" />
          </div>

          <div class="mb-2">
            <button type="submit" class="w-full bg-green-400 rounded-md py-1">Submit</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      const price = document.querySelector("#price").value

      function calAmount(e) {
        let amount = document.querySelector("#amount").value
        document.querySelector("#receive").value = parseFloat(amount / price).toFixed(8)
      }

      function calReceive() {
        let receive = document.querySelector("#receive").value
        document.querySelector("#amount").value = parseFloat(receive * price).toFixed(8)
      }
    </script>
  </div>
</x-Layouts.Market>