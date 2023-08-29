@props(['message' => '', 'buttonName' => 'ホームへ', 'path' => '/'])

<div class="mt-16 px-12 py-16 w-96 mx-auto bg-white text-center rounded-md shadow-lg">
  <h1 class="text-xl font-medium mb-8">{{ $message }}</h1>
  <a href="{{ $path }}" class="px-4 py-1 bg-blue-600 text-white rounded-md shadow-md">
    {{ $buttonName }}
  </a>
</div>