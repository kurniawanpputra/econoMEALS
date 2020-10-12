<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Calories Counter
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
        @if($isOpen)
            @include('livewire.counter')
        @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex flex-wrap justify-center">
                <div class="max-w-sm w-full lg:max-w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url({{ Auth::user()->profile_photo_url }})" title="Woman holding a mug"></div>
                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-6">
                            <div class="text-gray-900 font-bold text-xl mb-4">Hai, {{ Auth::user()->name }}! Kebutuhan kalori kamu hari ini adalah <span class="text-green-500">{{isset($todayCal->calories) ? number_format($todayCal->calories, 0, ',', '.') : '0'}}</span> Kcal.</div>
                            <p class="text-gray-700 text-base">Tahukah kamu? Jumlah kalori harian yang tubuh kamu butuhkan tidak hanya dihitung berdasarkan berat badan dan presentase lemak di tubuh,  
                            tetapi juga berdasarkan jenis kegiatan yang kamu lakukan dalam satu hari.</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-sm">
                                @if(!isset($todayCal->calories))
                                    <button wire:click="count()" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">Count My Needs</button>
                                @else
                                    <button wire:click="clear()" class="bg-yellow-400 hover:bg-yellow-300 text-white font-bold py-2 px-4 rounded">Reset Data</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>