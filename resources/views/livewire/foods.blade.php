<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage Foods
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if($isOpen)
                @include('livewire.create')
            @endif
            @if($isEdit)
                @include('livewire.edit')
            @endif
            <div class="flex flex-wrap justify-center">
                @foreach($foods as $food)
                    <div class="max-w-sm rounded overflow-hidden shadow-lg mx-1 my-2 justify-center flex flex-wrap text-center">
                        <img class="w-full" src="{{ isset($food->photo) ? asset($food->photo) : asset('img/no-image.jpg') }}" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $food->title }}</div>
                            <hr class="mb-2">
                            <p class="text-gray-700 text-base mb-2">{{ $food->body }}</p>
                            <hr class="mb-2">
                            <p class="text-gray-700 text-base">Location: {{ $food->location }}</p>
                            <p class="text-gray-700 text-base">Price: {{ 'Rp' . number_format($food->price, 2, ',', '.') }}</p>
                            <p class="text-gray-700 text-base">Status: <span class="font-bold @if($food->status == 'Available') text-green-500 @else text-red-500 @endif">{{ $food->status }}</span></p>
                            <p class="text-gray-700 text-base">Calories: {{number_format($food->calories, 0, ',', '.')}}</p>
                            <p class="text-gray-700 text-base">Sold: {{number_format($food->sold, 0, ',', '.')}}</p>
                            <!-- <p class="text-gray-700 text-base">Added: {{ date('d-m-Y H:i', strtotime($food->created_at)) }}</p> -->
                        </div>
                        <div class="px-6 pt-4 pb-2 mb-4">
                            <button wire:click="edit({{ $food->id }})" class="bg-yellow-400 hover:bg-yellow-300 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $food->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </div>
                    </div>
                @endforeach
                @if(count($foods) <= 0)
                    <span class="font-bold">No Foods Yet.</span>
                @endif
            </div>
        </div>
    </div>
    <div class="flex flex-wrap justify-center">
        <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6">Add New Food</button>
    </div>
</div>