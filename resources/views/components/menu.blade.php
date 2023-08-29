<div x-show="open" x-transition class="bg-white fixed z-10 top-0 left-0 w-full h-screen pt-32">
  @if(Request::routeIs('user.*'))
  <a href="{{ route('user.home') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Home</a>
  @auth('users')
  <a href="{{ route('user.mypage') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Mypage</a>
  <form method="POST" action="{{ route('user.logout') }}">
    @csrf
    <button class="block w-full my-4 text-center text-2xl text-blue-600">Logout</button>
  </form>
  @endauth
  @guest('users')
  <a href="{{ route('user.register') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Registration</a>
  <a href="{{ route('user.login') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Login</a>
  @endauth
  @endif

  @if(Request::routeIs('owner.*'))
  @auth('owners')
  <a href="{{ route('owner.home') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Home</a>
  <form method="POST" action="{{ route('owner.logout') }}">
    @csrf
    <button class="block w-full my-4 text-center text-2xl text-blue-600">Logout</button>
  </form>
  @endauth
  @endif

  @if(Request::routeIs('admin.*'))
  @auth('admin')
  <a href="{{ route('admin.home') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Home</a>
  <a href="{{ route('admin.owners') }}" class="block w-full my-4 text-center text-2xl text-blue-600">Owners</a>
  <form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button class="block w-full my-4 text-center text-2xl text-blue-600">Logout</button>
  </form>
  @endauth
  @endif
</div>