<x-guest-layout>

    <div class="w-full min-h-screen flex justify-center items-center">
        <div class="gap-4">
            <a href="{{ route('login') }}" class="bg-zinc-800 hover:bg-zinc-900  text-gray-50 p-4 uppercase font-semibold">Sign In</a>
            <a href="{{ route('register') }}" class="bg-zinc-800 text-gray-50 p-4 uppercase font-semibold">Sign Up</a>
        </div>
    </div>

</x-guest-layout>

