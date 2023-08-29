<div x-data="{ changed: false }" class="relative flex items-center justify-center bg-gray-100 w-60 mx-auto rounded-lg h-full shadow-lg">
  <p class="block text-center font-medium">新店舗を追加する<br><span class="text-red-500 text-sm">{{ $errors->first('csv_file') }}</span></p>

  <input type="file" name="csv_file" @input="changed = true" class="absolute top-0 left-0 w-full h-full opacity-0">

  <button x-show="changed" class="absolute top-3/4 text-gray-100 bg-blue-600 py-1 px-4 rounded-md shadow-lg">作成する</button>
</div>