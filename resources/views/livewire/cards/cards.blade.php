<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage cards (Laravel 8 Jetstream Livewire CRUD Example
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-x1 sm rounded-lg px-4 py-4">
            @if(session()->has('message'))
                <div class="bg-teal-100 border-lt-4 border teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover bg-blue-700 font-bold py-2 px-4 rounded my-3">Create Card</button>
            @if($isOpen)
                @include('livewire.cards.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-1000">
                    <th class="px-4 py2 w-20">No.</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Desc</th>
                    <th class="px-4 py-4">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cards as $card)
                    <tr>
                        <td class="border px-4 py-2">{{ $card->id }}</td>
                        <td class="border px-4 py-2">{{ $card->title }}</td>
                        <td class="border px-4 py-2">{{ $card->description }}</td>
                        <td class="border px-4 py2">
                            <button wire:click="edit({{ $card->id }})" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $card->id }})" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
