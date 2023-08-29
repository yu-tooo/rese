<x-layout>
  <div class="grid place-items-center grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-8 mt-8">
    @foreach($restaurants as $restaurant)
    <x-restaurant-card :restaurant="$restaurant" />
    @endforeach
  </div>
</x-layout> 