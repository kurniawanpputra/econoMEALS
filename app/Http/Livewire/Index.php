<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Food;

class Index extends Component
{
    public $foods, $food_id, $user_id, $qty, $phone, $status;
    public $isOpen = 0;

    public function render()
    {
        $this->foods = Food::orderBy('created_at', 'desc')->get();

        return view('livewire.index');
    }

    public function order($id)
    {
        $this->food_id = $id;
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->qty = '';
        $this->phone = '';
    }

    public function store()
    {
        $this->validate([
            'qty' => 'required',
            'phone' => 'required'
        ]);

        $order = new Order;
        $order->food_id = $this->food_id;
        $order->user_id = auth()->user()->id;
        $order->seller_id = Food::find($this->food_id)->user_id;
        $order->qty = $this->qty;
        $order->phone = $this->phone;
        $order->status = "Pending";
        $order->save();

        $food = Food::find($this->food_id);
        $food->sold += $this->qty;
        $food->save();

        session()->flash('message', 'Thank You! The Seller Will Contact You Soon Enough.');
        return redirect()->route('purchases');
  
        $this->closeModal();
        $this->resetInputFields();
    }
}
