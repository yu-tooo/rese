<div class="bg-white mx-auto w-96 shadow-lg p-4 rounded-b-md text-right">
  <div class="flex items-center border-b">
    <x-icons.email />
    <input type="email" name="email" class="w-full border-none focus:ring-0" placeholder="Email">
  </div>
  <p class="text-sm text-red-500 text-center">{{ $errors->first('email') }}</p>

  <div class="flex items-center border-b">
    <x-icons.password />
    <input type="password" name="password" class="w-full border-none focus:ring-0" placeholder="Password">
  </div>
  <p class="text-sm text-red-500 text-center">{{ $errors->first('password') }}</p>

  <button class="mt-4 px-4 py-0.5 bg-blue-600 text-white rounded-md shadow-md">ログイン</button>
</div>