<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Foods
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-green-900 text-center py-4 lg:px-4 sm:rounded-lg mb-3">
            <a href="{{route('calories')}}">
                <div class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Calorie Counter</span>
                    <span class="font-semibold mr-2 text-left flex-auto hover:underline">You calorie intake is {{number_format($todayCal, 0, ',', '.')}} calories today. Unsure? Recheck you daily needs now.</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                </div>
            </a>
        </div>
        <!-- @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if($isOpen)
                @include('livewire.order')
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
                            <p class="text-gray-700 text-base">Seller: {{ \App\Models\User::find($food->user_id)->name }}</p>
                            <p class="text-gray-700 text-base">Location: {{ $food->location }}</p>
                            <p class="text-gray-700 text-base">Price: {{ 'Rp' . number_format($food->price, 2, ',', '.') }}</p>
                            <p class="text-gray-700 text-base">Status: <span class="font-bold @if($food->status == 'Available') text-green-500 @else text-red-500 @endif">{{ $food->status }}</span></p>
                            <p class="text-gray-700 text-base">Calories: {{number_format($food->calories, 0, ',', '.')}} Kcal</p>
                            <!-- <p class="text-gray-700 text-base">Sold: {{ $food->sold }}</p> -->
                            <!-- <p class="text-gray-700 text-base">Added: {{ date('d-m-Y H:i', strtotime($food->created_at)) }}</p> -->
                        </div>
                        <div class="px-6 pt-4 pb-2 mb-4">
                            <button wire:click="order({{ $food->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Place Order</button>
                        </div>
                    </div>
                @endforeach
                @if(count($foods) <= 0)
                    <span class="font-bold">No Foods Yet.</span>
                @endif
            </div>
        </div>
    </div>
</div>
