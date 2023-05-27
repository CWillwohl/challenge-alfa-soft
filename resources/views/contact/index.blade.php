<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact list') }}
        </h2>
    </x-slot>

    <div class="w-full flex justify-center">
        <div class="w-full md:w-1/2
        flex flex-col justify-center items-start m-8 gap-4
        bg-white">

            <div class="w-full flex p-4 bg-slate-200">
                <a href="{{ route('contacts.create') }}" class="bg-zinc-800 hover:bg-zinc-900 duration-300 text-white p-4">Create a new Contact</a>
            </div>
            <table class="w-full">
                <thead class="bg-zinc-800 text-gray-100">
                    <tr>
                        <th class="border border-zinc-800 p-4">ID</th>
                        <th class="border border-zinc-800 p-4">Name</th>
                        <th class="border border-zinc-800 p-4">Email</th>
                        <th class="border border-zinc-800 p-4">Contact</th>
                        <th class="border border-zinc-800 p-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($contacts as $contact)
                        <tr>
                            <td class="border border-zinc-800">{{ $contact->id }}</td>
                            <td class="border border-zinc-800">{{ $contact->name }}</td>
                            <td class="border border-zinc-800">{{ $contact->email }}</td>
                            <td class="border border-zinc-800">{{ $contact->contact }}</td>
                            <td class="border border-zinc-800 p-4">
                                <div class="flex flex-row justify-center items-center gap-4">
                                    <a href="{{ route('contacts.edit', $contact) }}" type="button" class="bg-zinc-800 hover:bg-zinc-900 duration-300 text-zinc-100 p-2 rounded uppercase">Edit</a>
                                    <a href="{{ route('contacts.show', $contact) }}" type="button" class="bg-sky-500 hover:bg-sky-600 duration-300 text-white p-2 rounded uppercase">View</a>
                                    <form action="{{ route('contacts.destroy', $contact) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" href="{{ route('contacts.destroy', $contact) }}" class="bg-red-500 hover:bg-red-600 duration-300 text-white p-2 rounded uppercase">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border border-zinc-800 p-4" colspan="5">No contacts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
