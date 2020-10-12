<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class Orders extends Component
{
    public $orders, $status;

    public function render()
    {
        $this->orders = Order::where('seller_id', auth()->user()->id)
                             ->orderBy('created_at', 'desc')
                             ->get();

        return view('livewire.orders');
    }

    public function changeStatus($id)
    {
        $order = Order::find($id);

        if($order->status == "Pending") {
            $order->status = "Accepted";
        }else{
            $order->status = "Pending";
        }

        $order->save();

        session()->flash('message', 'Status Updated Successfully.');
    }

    public function reject($id)
    {
        $order = Order::find($id);

        $order->status = "Rejected";

        $order->save();

        session()->flash('message', 'Order Rejected Successfully.');
    }
}
