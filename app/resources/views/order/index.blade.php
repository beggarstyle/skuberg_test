<x-Layouts.App>
  <div class="w-full bg-white rounded-sm p-2 mb-2">
    <h2>Orders</h2>
  </div>

  <div class="w-full bg-white rounded-sm p-2 mb-2">
    <table class="w-full">
      <thead class="h-8">
        <tr>
          <th class="text-center">Date</th>
          <th class="text-center">Symbol</th>
          <th class="text-center">Type</th>
          <th class="text-center">Price</th>
          <th class="text-center">Volume</th>
        </tr>
      </thead>

      <tbody>
        @foreach($orders as $order)
          <tr class="h-12 border-b">
            <td>{{ $order->created_at }}</td>
            <td class="text-center">{{ $order->market->symbol->symbol }}</td>
            <td class="text-center">
              <p class="{{ $order->type == 1 ? 'text-green-400' : 'text-red-400' }}">
                {{ $order->type == 1 ? 'Buy' : 'Sell' }}
              </p>
            </td>
            <td class="text-right">{{ $order->amount }}</td>
            <td class="text-right">{{ $order->receive }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-Layouts.App>
