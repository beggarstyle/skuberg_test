<x-Layouts.App>
  <div class="w-full bg-white rounded-sm p-2 mb-2">
    <h2>Wallet</h2>
  </div>

  <div class="w-full bg-white rounded-sm p-2 mb-2">
    <table class="w-full">
      <thead>
        <tr class="h-10">
          <th class="text-sm text-left">เหรียญ</th>
          <th class="text-sm text-center">ยอดคงเหลือ</th>
          <th class="text-sm text-center">ยอดที่สามารถใช้ได้</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        @foreach($symbols as $symbol)
          <tr class="h-12 border-b">
            <td>
              <div class="flex flex-row justify-start">
                <img
                  src="/icons/{{ str_replace('THB_', '', $symbol->symbol) }}.png"
                  alt="{{ $symbol->info }}"
                  class="w-6 h-6 mx-2"
                />

                <p class="text-sm">
                  {{ $symbol->info }} ({{ $symbol->symbol }})
                </p>
              </div>
            </td>
            <td class="text-right" width="140">{{ number_format($symbol->available, 8, '.', '') }}</td>
            <td class="text-right" width="140">{{ number_format($symbol->actual, 8, '.', '') }}</td>
            <td class="text-center">
              <a
                href="{{ route('wallet.deposit', ['symbol' => $symbol->symbol]) }}"
                class="w-16 h-8 border bg-green-400 text-white px-4 py-1"
              >
                ฝาก
              </a>

              <a
                href="{{ route('wallet.withdraw', ['symbol' => $symbol->symbol]) }}"
                class="w-16 h-8 border bg-red-400 text-white px-4 py-1"
              >
                ถอน
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-Layouts.App>