<x-Layouts.App>
  <div class="w-full h-full p-2">
    <div class="flex flex-col flex-wrap">
      <div class="w-full bg-white mx-2 mb-2 p-2">
        <h1 class="mb-4">Wallet</h1>

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
    </div>
  </div>
</x-Layouts.App>