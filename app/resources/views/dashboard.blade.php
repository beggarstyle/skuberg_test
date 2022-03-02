<x-Layouts.App>
  <div class="w-full h-full p-2">
    <div class="flex flex-col flex-wrap">
      <div class="w-full bg-white rounded-sm mx-2 mb-2 p-2">
        <h2>Balance Details</h2>
        <hr class="my-2" />

        <div></div>
      </div>

      <div class="w-full bg-white rounded-sm mx-2 mb-2 p-2">
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
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="text-center" colspan="5">No Records Found.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-Layouts.App>
