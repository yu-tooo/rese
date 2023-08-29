<x-layout>
    <div class="bg-blue-600 mx-auto mt-16 p-4 text-white w-96 rounded-t-md">
        Login for OWNER
    </div>
    <form method="POST" action="{{ route('owner.login') }}">
        @csrf
        <x-login-card />
    </form>
</x-layout>