<x-layout>
  <div class="md:flex flex-row-reverse justify-between">
    <div class="mt-4 md:w-1/2">
      <h2 class="text-xl font-extrabold">{{ $user->name }}さん</h2>
      <h3 class="text-lg font-extrabold pt-4">お気に入り店舗</h3>
      <div class="grid place-items-center grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 gap-x-2 gap-y-4 mt-4">
        @foreach($restaurants as $restaurant)
        <x-restaurant-card :restaurant="$restaurant" />
        @endforeach
      </div>
    </div>
    <div class="mt-12 md:w-5/12">
      <h3 class="text-lg font-extrabold">予約状況</h3>
      @foreach($user->reservations as $reservation)
      <a href="{{ route('user.reservation', ['id' => $reservation->id]) }}"><x-reservation-card :reservation="$reservation" />
      </a>
      @endforeach
    </div>
  </div>
</x-layout>