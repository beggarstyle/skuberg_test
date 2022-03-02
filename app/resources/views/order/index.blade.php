<x-Layouts.App>
  <div class="w-full h-full p-2">
    <div class="flex flex-col flex-wrap">
      <div class="w-full bg-white mx-2 mb-2 p-2">
        <h2>Open Orders</h2>
        <hr class="my-2" />

        <div>
          <table class="w-full">
            <thead class="h-8">
              <tr>
                <th>Pair Date</th>
                <th>Type / Side Trigger Conditions</th>
                <th>Price</th>
                <th>Total</th>
                {{-- <th>Action</th> --}}
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
                <tr>
                  {{-- <td class="text-center" colspan="5">No Records Found.</td> --}}
                  <td></td>
                  <td class="text-right">
                    <p class="{{ $order->market->type == 1 ? 'text-green-400' : 'text-red-400' }}">
                      {{ $order->market->type == 1 ? 'Buy' : 'Sell' }}
                    </p>
                  </td>
                  <td class="text-right">{{ $order->amount }}</td>
                  <td class="text-right">{{ $order->receive }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-Layouts.App>
