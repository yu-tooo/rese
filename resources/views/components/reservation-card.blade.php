<div class="bg-blue-600 py-4 rounded-md mt-4 shadow-lg">
  <h4 class="flex items-center justify-between text-white ml-8 mr-4 mb-2">
    <span>
      <x-icons.clock />
      予約
    </span>
    <form method="POST" action="{{ route('user.mypage') }}">
      @csrf
      <input type="hidden" name="id" value="{{ $reservation->id }}">
      <button><x-icons.x-circle /></button>
    </form>
  </h4>
  <table class="border-separate border-spacing-x-8 font-medium text-gray-100">
    <tr>
      <td>Shop</td>
      <td>{{ $reservation->restaurant->name }}</td>
    </tr>
    <tr>
      <td>Date</td>
      <td>{{ $reservation->date }}</td>
    </tr>
    <tr>
      <td>Time</td>
      <td>{{ substr($reservation->time, 0, 5)}}</td>
    </tr>
    <tr>
      <td>Number</td>
      <td>{{ $reservation->number }} 人</td>
    </tr>
  </table>
</div>