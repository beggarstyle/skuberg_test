<x-Layouts.Login>
  <section class="w-screen h-screen flex flex-col justify-center items-center">
    <div class="flex flex-col border border-slate-400 rounded-xl shadow-xl p-6">
      <h2 class="text-4xl mb-4">Account Login</h2>
      <p class="text-lg mb-6">Welcome back! Log In with your Email</p>

      <form action="/signin" method="post">
        {{ csrf_field() }}
        <div class="flex flex-col mb-4">
          <label for="" class="mb-1">Email</label>
          <input
            type="text"
            class="border rounded-sm border-gray-400 leading-8"
            name="email"
            autocomplete="off"
            required
          />
        </div>

        <div class="flex flex-col mb-4">
          <label for="" class="mb-1">Password</label>
          <input
            type="password"
            class="border rounded-sm border-gray-400 leading-8"
            name="password"
            autocomplete="off"
            minlength="6"
            required
          />
        </div>

        <div class="flex flex-col mb-4">
          <button
            type="submit"
            class="w-full h-full border rounded-sm border-gray-400 py-2 hover:border-black"
          >
            Login
          </button>
        </div>

        <p>
          <a href="" class="hover:underline">Forget Password?</a>
        </p>

        <p>
          <a href="{{ route('register') }}" class="hover:underline">Register now</a>
        </p>

        {{-- <div>
          <label for="">Password</label>
          <input type="password" class="border rounded-sm border-gray-700 leading-3" name="password" autocomplete="false" required />
        </div> --}}

        {{-- <input type="text" /> --}}
      </form>
    </div>

  </section>
</x-Layouts.Login>