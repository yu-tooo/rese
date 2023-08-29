<x-layout>
  <div class="flex items-center my-4">
    <a href="{{ route('admin.home') }}">
      <x-icons.chavron-left />
    </a>
    <h2 class="text-xl font-bold ml-4">{{ $restaurant->name }}</h2>
  </div>
  <div class="md:flex justify-between">
    <div class="mb-4 md:w-1/2">
      @if(count($restaurant->reservations) > 0)
      <h3 class="text-lg font-bold ml-8">予約情報</h3>
      <table class="table-fixed mt-1 mb-8">
        <tr>
          <th class="w-16">No.</th>
          <th class="w-32">日時</th>
          <th class="w-16">人数</th>
          <th class="text-left pl-8">代表者名</th>
        </tr>
        @foreach($restaurant->reservations as $i => $reservation)
        <tr>
          <td class="text-center">{{ $i + 1 }}</td>
          <td class="text-center">{{ substr($reservation->date, 2)}} {{ substr($reservation->time, 0, 5)}}</td>
          <td class="text-center">{{ $reservation->number }}</td>
          <td class="text-left pl-8">{{ $reservation->user->name }}</td>
        </tr>
        @endforeach
      </table>
      @endif
      <img class="w-full h-56 object-cover" src="{{ asset('storage/'. $restaurant->img_url) }}">
      <p class="font-medium my-4">#{{ $restaurant->detail->area}} #{{ $restaurant->detail->genre }}</p>
      <p class="font-medium mb-4">{{ $restaurant->comment }}</p>
      @if($restaurant->comments->isNotEmpty())
      <h4 class="text-center text-white py-1 mt-8 bg-blue-500">全ての口コミ情報</h4>
      @foreach($restaurant->comments as $comment)
      <x-comment-card :comment="$comment" />
      @endforeach
      @endif
    </div>
    <div class="bg-blue-600 rounded-md pt-4 md:w-5/12 h-fit">
      <h3 class="text-white text-lg font-bold ml-8">店舗情報更新</h3>
      @if(count($errors) > 0)
      <p class="bg-gray-300 text-center mx-8 rounded-md text-red-500">更新に失敗しました</p>
      @endif
      <form method="POST" action="{{ route('admin.detail', ['id' => $restaurant->id]) }}" enctype="multipart/form-data">
        @csrf
        <select name="owner_id" class="h-8 py-0 mt-4 rounded-md ml-4">
          <option value="">No Owner</option>
          @foreach($owners as $owner)
          <option value="{{ $owner->id }}" {{ $owner->id == $restaurant->owner_id ? 'selected' : '' }}>
            {{ $owner->name }}
          </option>
          @endforeach
        </select>
        <p class="pl-4 text-red-500">{{ $errors->first('owner_id') }}</p>

        <input type="text" name="name" value="{{ $restaurant->name }}" class="block py-1 mt-4 rounded-md ml-4">
        <p class="pl-4 text-red-500">{{ $errors->first('name') }}</p>

        <textarea class="focus:ring-0 focus:ring-gray-300 resize-none ml-4 w-11/12 rounded-md mt-4" name="comment" cols="30" rows="5">{{ $restaurant->comment }}</textarea>
        <p class="pl-4 text-red-500">{{ $errors->first('comment') }}</p>

        <div x-data="{ imagePreview: null }" class="flex items-center justify-center relative bg-gray-100 h-36 mt-4 mb-2 ml-4 w-11/12 rounded-md">
          <p class="text-center text-sm font-medium">クリックして画像を追加<br>またはドロッグアンドドロップ</p>
          <input type="file" name="image" @change="imagePreview = URL.createObjectURL($event.target.files[0])" class="absolute top-0 left-0 w-full h-full opacity-0">
          <div x-show="imagePreview" class="absolute w-full h-full">
            <img :src="imagePreview" alt="Image Preview" class="w-full h-full object-cover">
          </div>
        </div>
        <p class="pl-4 text-red-500">{{ $errors->first('image') }}</p>
        <button class="w-full mt-16 py-2 text-lg bg-blue-700 text-white rounded-b-md">更新する</button>
      </form>
    </div>
  </div>
</x-layout>