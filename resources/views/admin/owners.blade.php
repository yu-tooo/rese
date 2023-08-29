<x-layout>
  <div class="w-full sm:w-11/12 md:w-4/5 lg:w-3/5 mx-auto">
    <h1 class="text-xl font-bold text-center mb-4">オーナー</h1>
    <table class="border-collapse border-y border-black w-full mx-auto my-4">
      <tr class="text-lg border-b border-black">
        <th class="border-r border-black py-1.5">名前</th>
        <th class="py-1.5">メールアドレス</th>
      </tr>
      @foreach($owners as $owner)
      <tr>
        <th class="px-8 py-2 border-r border-black">{{ $owner->name }}</th>
        <th class="px-8 py-2">{{ $owner->email }}</th>
      </tr>
      @endforeach
    </table>
    <h2 class="bg-blue-600 mx-auto p-4 text-white w-96 rounded-t-md">新規作成</h2>
    <form method="POST" action="{{ route('admin.owners') }}">
      @csrf
      <x-register-card />
    </form>
  </div>
</x-layout>