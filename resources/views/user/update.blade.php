<x-layout>
  <div class="flex items-center my-4">
    <a href="{{ route('user.mypage') }}">
      <x-icons.chavron-left />
    </a>
    <h2 class="text-xl font-bold ml-4">{{ $reservation->restaurant->name }}</h2>
  </div>
  <div class="md:flex justify-between">
    <div class="mb-4 md:w-1/2">
      <img class="w-full h-56 object-cover" src="{{ asset('storage/'. $reservation->restaurant->img_url) }}">
      <p class="font-medium my-4">
        #{{ $reservation->restaurant->detail->area}}
        #{{ $reservation->restaurant->detail->genre }}
      </p>
      <p class="font-medium mb-4">{{ $reservation->restaurant->comment }}</p>
    </div>
    @if(count($errors) > 0)
    <p class="absolute top-10 left-1/2 -translate-x-1/2 text-red-500">
      予約変更に失敗しました
    </p>
    @endif
    <div x-data="{ date:'', time: '', num: '' }" class="bg-blue-600 rounded-md pt-4 md:w-5/12">
      <h3 class="text-white text-lg font-bold ml-8">予約変更</h3>
      <form method="POST" action="{{ route('user.reservation', ['id' => $reservation->id]) }}">
        @csrf
        <input x-model="date" type="date" name="date" class="block py-1 mt-4 rounded-md ml-4">
        <p class="pl-4 text-red-500">{{ $errors->first('date') }}</p>
        <select x-model="time" name="time" class="block w-11/12 py-1 mt-4 rounded-md ml-4">
          <option value="" hidden>選択してください</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
          <option value="14:30">14:30</option>
          <option value="17:30">17:30</option>
          <option value="18:00">18:00</option>
          <option value="18:30">18:30</option>
          <option value="19:00">19:00</option>
          <option value="19:30">19:30</option>
          <option value="20:00">20:00</option>
        </select>
        <p class="pl-4 text-red-500">{{ $errors->first('time') }}</p>
        <select x-model="num" name="number" class="block w-11/12 py-1 mt-4 rounded-md ml-4">
          <option value="" hidden>選択してください</option>
          @for($i = 1; $i <= 8; $i++) <option value="{{ $i }}">{{ $i }} 人</option>
            @endfor
        </select>
        <p class="pl-4 text-red-500">{{ $errors->first('number') }}</p>
        <div class="w-10/12 bg-blue-500 py-4 rounded-md ml-4 mt-4">
          <table class="border-separate border-spacing-x-8 font-medium text-gray-100">
            <tr>
              <td>Shop</td>
              <td>{{ $reservation->restaurant->name }}</td>
            </tr>
            <tr>
              <td>Date</td>
              <td x-text="date"></td>
            </tr>
            <tr>
              <td>Time</td>
              <td x-text="time"></td>
            </tr>
            <tr>
              <td>Number</td>
              <td x-text="num" class="after:content-['人']"></td>
            </tr>
          </table>
        </div>
        <button class="w-full mt-16 py-2 text-lg bg-blue-700 text-white rounded-b-md">予約変更する</button>
      </form>
    </div>
  </div>
</x-layout>