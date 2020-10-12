<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class Purchases extends Component
{
    public $purchases;
    
    public function render()
    {
        $this->purchases = Order::where('user_id', auth()->user()->id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('livewire.purchases');
    }
}
