<div class="w-80 h-full min-h-screen bg-white border">
  <ul>
    <li class="{{ Request::route()->getName() === 'dashboard' ? 'border-l-4 border-l-black font-bold' : '' }} py-3 px-0 hover:bg-gray-200 ">
      <a href="/" class="w-full h-full flex text-lg font-dthin ml-2">Dashboard</a>
    </li>

    <li class="{{ Request::route()->getName() === 'wallet.index' ? 'border-l-4 border-l-black font-bold' : '' }} font-thin py-3 px-0 hover:bg-gray-200">
      <a
        href="{{ route('wallet.index') }}"
        class="w-full h-full flex text-lg ml-2"
      >
        Wallet
      </a>
    </li>

    <li class="{{ Request::route()->getName() === 'order.index' ? 'border-l-4 border-l-black font-bold' : '' }} font-thin py-3 px-0 hover:bg-gray-200">
      <a
        href="{{ route('order.index') }}"
        class="w-full h-full flex text-lg ml-2"
      >
        Orders
      </a>
    </li>
  </ul>
</div>
