<div x-data="{ open: false }">
  <x-menu />
  <div class="flex">
    <span x-on:click="open = ! open" class="relative z-50 bg-blue-600 block w-8 h-8 rounded shadow-2xl cursor-pointer">
      <!-- メニュー非公開時のアイコン線 -->
      <span x-show="! open" class="absolute top-1/2 translate-x-2 -translate-y-1.5 block bg-white border border-gray-300 w-1/4"></span>
      <span x-show="! open" class="absolute top-1/2 translate-x-2 block bg-white border border-gray-300 w-1/2"></span>
      <span x-show="! open" class="absolute top-1/2 translate-x-2 translate-y-1.5 block bg-black border border-gray-300 w-1/5"></span>

      <!-- メニュー公開時のアイコン線 -->
      <span x-show="open" class="absolute top-1/2 w-1/2 translate-x-2 rotate-45 block bg-white border border-gray-300"></span>
      <span x-show="open" class="absolute top-1/2 w-1/2 translate-x-2 -rotate-45 block bg-white border border-gray-300"></span>
    </span>
    <a href="{{ route('user.home') }}">
      <h1 class="text-2xl font-black text-blue-600 ml-4">Rese</h1>
    </a>
  </div>
</div>