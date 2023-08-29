<x-layout>
    <div class="bg-blue-600 mx-auto mt-16 p-4 text-white w-96 rounded-t-md">
        Registration
    </div>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <x-register-card />
    </form>
</x-layout>