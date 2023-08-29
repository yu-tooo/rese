<div class="w-60 mx-auto rounded-lg bg-white pb-2 shadow-lg">
  @if(Request::routeIs('user.*'))
  <a href="{{ route('user.detail', ['id' => $restaurant->id]) }}">
    <img src="{{ asset('storage/'. $restaurant->img_url) }}" class="w-full h-32 object-cover rounded-t-lg">
  </a>
  @endif
  @if(Request::routeIs('owner.*'))
  <a href="{{ route('owner.detail', ['id' => $restaurant->id]) }}">
    <img src="{{ asset('storage/'. $restaurant->img_url) }}" class="w-full h-32 object-cover rounded-t-lg">
  </a>
  @endif
  @if(Request::routeIs('admin.*'))
  <a href="{{ route('admin.detail', ['id' => $restaurant->id]) }}">
    <img src="{{ asset('storage/'. $restaurant->img_url) }}" class="w-full h-32 object-cover rounded-t-lg">
  </a>
  @endif
  <h4 class="ml-4 pt-3 font-bold">{{ $restaurant->name }}</h4>
  <p class="ml-4 text-sm mt-1 mb-2 font-medium">
    #{{ $restaurant->detail->area }} #{{ $restaurant->detail->genre }}
  </p>
  @if(Request::routeIs('user.*'))
  <a class="ml-4 px-4 py-1.5 bg-blue-600 text-white rounded-md text-sm shadow-lg" href="{{ route('user.detail', ['id' => $restaurant->id]) }}">詳しくみる</a>
  @if(Auth::guard('users')->check()
  && $restaurant->like->isExist(Auth::guard('users')->id()))
  <form method="POST" action="{{ route('user.like.delete', ['id' => $restaurant->id]) }}" class="inline"> @csrf
    <button><x-icons.likeHeart /></button>
  </form>
  @else
  <form method="POST" action="{{ route('user.like.create', ['id' => $restaurant->id]) }}" class="inline"> @csrf
    <button><x-icons.unlikeHeart /></button>
  </form>
  @endif
  @endif
</div>