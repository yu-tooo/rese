<div class="pb-8 mt-6 px-6 border-y border-gray-600">
  <div class="text-right py-1">
    @if($comment->isOwnComment(Auth::guard('users')->id()))
    <a href="{{ route('user.recomment', ['id' => $comment->id]) }}" class="text-sm font-medium ml-4 underline decoration-1 underline-offset-2">口コミを編集</a>
    <form method="POST" action="{{ route('user.delcomment', ['id' => $comment->id]) }}" class="inline"> @csrf
      <button href="" class="text-sm font-medium ml-4 underline decoration-1 underline-offset-2">口コミを削除</button>
    </form>
    @elseif(Request::routeIs('admin.*'))
    <form method="POST" action="{{ route('admin.delcomment', ['id' => $comment->id]) }}" class="inline"> @csrf
      <button href="" class="text-sm font-medium ml-4 underline decoration-1 underline-offset-2">口コミを削除</button>
    </form>
    @endif
  </div>
  <div class="flex justify-between space-x-1">
    <div class="flex-1">
      @switch($comment->rate)
      @case(1)
      <p class="font-medium ml-6">不満です</p>
      @break
      @case(2)
      <p class="font-medium ml-6">やや不満です</p>
      @break
      @case(3)
      <p class="font-medium ml-6">満足です</p>
      @break
      @case(4)
      <p class="font-medium ml-6">大変満足です</p>
      @break
      @case(5)
      <p class="font-medium ml-6">非常に満足です</p>
      @break
      @endswitch

      <div x-data="{ rating: {{ $comment->rate }} }" class="flex mb-2">
        <template x-for="star in [1, 2, 3, 4, 5]" :key="index">
          <x-icons.star />
        </template>
      </div>
      <p>{{ $comment->body }}</p>
    </div>
    <div class="flex flex-row-reverse pt-8 w-32">
      @if($comment->img_url)
      <img src="{{ asset('storage/'. $comment->img_url) }}" class="w-28 h-28 rounded-full object-cover">
      @endif
    </div>
  </div>
</div>