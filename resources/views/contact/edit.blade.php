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

            <div class="w-full p-4">

                <hr class="w-full my-2">
                <form method="POST" action="{{ route('contacts.update', $contact) }}" class="w-full space-y-4">
                @csrf
                @method('put')

                <div class="w-full flex flex-col gap-2">
                    <label for="name">Name <span class="text-zinc-800 font-semibold">(min 5 characters)</span></label>
                    <input type="text" name="name" id="name" class="w-full rounded shadow" value="{{ old('name') ?? $contact->name }}">
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label for="contactData">Contact <span class="text-zinc-800 font-semibold">(9 caracters)</span></label>
                    <input type="text" name="contactData" id="contactData" class="w-full rounded shadow" value="{{ old('contact') ?? $contact->contact }}">
                    @error('contact')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="w-full flex flex-col gap-2">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="w-full rounded shadow" value="{{ old('email') ?? $contact->email }}">
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <hr class="w-full my-2">

            </div>
            <div class="w-full flex p-4 bg-slate-200">
                <div class="w-full flex justify-end">
                    <button class="bg-green-500 hover:bg-green-600 duration-300 text-white p-4">Update this Contact</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
