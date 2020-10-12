<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My Orders
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

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Food</th>
                        <th class="px-4 py-2">Customer</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Calories</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Ordered At</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($purchases as $index=>$order)
                    <tr>
                        <td class="border px-4 py-2">{{ $index+1 }}</td>
                        <td class="border px-4 py-2">{{ \App\Models\Food::find($order->food_id)->title }}</td>
                        <td class="border px-4 py-2">{{ \App\Models\User::find($order->user_id)->name }}</td>
                        <td class="border px-4 py-2">{{ $order->qty }} x {{ \App\Models\Food::find($order->food_id)->price }} = Rp{{ number_format($order->qty * \App\Models\Food::find($order->food_id)->price, 2, ',', '.') }}</td>
                        <td class="border px-4 py-2">{{ number_format(\App\Models\Food::find($order->food_id)->calories, 0, ',', '.') }} Kcal / Serving</td>
                        <td class="border px-4 py-2">{{ $order->phone }}</td>
                        <td class="border px-4 py-2"><span class="font-bold">{{ $order->status }}</span></td>
                        <td class="border px-4 py-2">{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
