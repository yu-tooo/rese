<x-layout>
  <div class="md:flex justify-between">
    <div class="h-fit mt-8 md:mt-20 md:w-5/12 md:border-r border-gray-400">
      <h2 class="px-16 text-2xl md:text-2xl text-center font-medium pb-4 md:pb-10">
        今回のご利用はいかがでしたか？
      </h2>
      <x-restaurant-card :restaurant="$restaurant" />
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.comment', ['id' => $restaurant->id]) }}" class="md:w-1/2 mt-8 md:mt-0"> @csrf
      <h3 class="text-xl font-medium">体験を評価してください</h3>
      <div x-data="{ rating: 0 }" class="flex pt-2">
        <template x-for="star in [1, 2, 3, 4, 5]" :key="index">
          <label :for="star" x-on:click="rating = star">
            <x-icons.star />
            <input type="radio" name="rate" :id="star" :value="star" class="hidden">
          </label>
        </template>
      </div>

      <h4 class="text-xl font-medium pt-6 pb-2">口コミを投稿</h4>
      <div x-data="{ text: '', count: 0 }">
        <textarea x-model="text" x-on:input="count = text.length" class="w-full focus:ring-0 focus:ring-gray-300 resize-none bg-gray-200" name="body" cols="30" rows="5" placeholder="カジュアルな夜のお出かけにおすすめのスポット"></textarea>
        <p x-text="count" :class="{ 'text-red-500': count > 400 }" class="text-right text-sm -mt-1 font-medium after:content-['/400\00A0(最高文字数)']"></p>
      </div>

      <h4 class="text-xl font-medium pt-6 pb-2">画像の追加</h4>
      <div x-data="{ imagePreview: null }" class="flex items-center justify-center relative bg-gray-100 h-36">
        <p class="text-center text-sm font-medium">クリックして画像を追加<br>またはドロッグアンドドロップ</p>
        <input type="file" name="image" @change="imagePreview = URL.createObjectURL($event.target.files[0])" class="absolute top-0 left-0 w-full h-full opacity-0">
        <div x-show="imagePreview" class="absolute w-full h-full">
          <img :src="imagePreview" alt="Image Preview" class="w-full h-full object-cover">
        </div>
      </div>
  </div>
  <button class="block mx-auto mt-8 rounded-3xl bg-gray-100 px-40 py-2 font-medium shadow-sm">口コミを投稿</button>
  </form>
  @if(count($errors) > 0)
  <div class="text-center text-red-500 mt-8">
    <p>{{ $errors->first('rate') }}</p>
    <p>{{ $errors->first('body') }}</p>
    <p>{{ $errors->first('image') }}</p>
  </div>
  @endif
</x-layout>