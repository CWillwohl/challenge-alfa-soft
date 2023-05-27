<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new Contact') }}
        </h2>
    </x-slot>

    <div class="w-full flex justify-center">
        <div class="w-full md:w-1/2
        flex flex-col justify-center items-start m-8 gap-4
        bg-white">

            <div class="w-full flex p-4 bg-slate-200">
                <a href="{{ route('contacts.index') }}" class="bg-zinc-800 hover:bg-zinc-900 duration-300 text-white p-4">Show contacts list</a>
            </div>
            <div class="w-full p-4 space-y-4">
                <hr class="w-full my-2">

                <div class="w-full flex flex-col gap-2">
                    <label for="name">Name <span class="text-zinc-800 font-semibold">(min 5 characters)</span></label>
                    <input type="text" name="name" id="name" disabled class="w-full cursor-not-allowed bg-gray-100 rounded shadow" value="{{ $contact->name }}">
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label for="contact">Contact <span class="text-zinc-800 font-semibold">(9 caracters)</span></label>
                    <input type="text" name="contact" id="contact" disabled class="w-full cursor-not-allowed bg-gray-100 rounded shadow" value="{{ $contact->contact }}">
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" disabled class="w-full cursor-not-allowed bg-gray-100 rounded shadow" value="{{ $contact->email }}">
                </div>

                <hr class="w-full my-2">
            </div>

            <div class="w-full flex p-4 bg-slate-200">
                <div class="w-full flex justify-between">
                    <form action="{{ route('contacts.destroy', $contact) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" href="{{ route('contacts.destroy', $contact) }}" class="bg-red-500 hover:bg-red-600 duration-300 text-white p-4 uppercase">Delete</button>
                    </form>
                    <a href="{{ route('contacts.edit', $contact) }}" class="bg-zinc-800 hover:bg-zinc-900 duration-300 text-white p-4 uppercase">Edit this Contact</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
