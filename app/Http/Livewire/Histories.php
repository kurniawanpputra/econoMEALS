<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class Histories extends Component
{
    public $orders;

    public function render()
    {
        $this->orders = Order::orderBy('created_at', 'desc')
                             ->get();

        return view('livewire.histories');
    }
}
