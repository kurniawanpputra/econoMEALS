<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage Orders
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded text-teal-900 px-4 py-3 shadow-md mb-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 rounded mb-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>This page will refresh every minute to check for a new order.</p>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Food</th>
                        <th class="px-4 py-2">Customer</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Ordered At</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($orders as $index=>$order)
                    <tr>
                        <td class="border px-4 py-2">{{ $index+1 }}</td>
                        <td class="border px-4 py-2">{{ \App\Models\Food::find($order->food_id)->title }}</td>
                        <td class="border px-4 py-2">{{ \App\Models\User::find($order->user_id)->name }}</td>
                        <td class="border px-4 py-2">{{ $order->qty }} x {{ \App\Models\Food::find($order->food_id)->price }} = Rp{{ number_format($order->qty * \App\Models\Food::find($order->food_id)->price, 2, ',', '.') }}</td>
                        <td class="border px-4 py-2">{{ $order->phone }}</td>
                        <td class="border px-4 py-2"><span class="font-bold">{{ $order->status }}</span></td>
                        <td class="border px-4 py-2">{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</td>
                        <td class="border px-4 py-2">
                            @if($order->status == "Pending")
                                <button wire:click="changeStatus({{$order->id}})" class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-2 rounded">Mark Done</button>
                            @elseif($order->status == "Done")
                                <button wire:click="changeStatus({{$order->id}})" class="bg-yellow-400 hover:bg-yellow-300 text-white font-bold py-1 px-2 rounded">Mark Pending</button>
                            @endif

                            @if($order->status != "Rejected")
                                <button wire:click="reject({{ $order->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" id="reject">Reject</button>
                            @elseif($order->status == "Rejected")
                                <p class="py-1 px-2">No action needed.</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    setInterval(function() {
        window.location.reload();
    }, 60000); 
</script>