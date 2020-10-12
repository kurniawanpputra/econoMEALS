<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Calorie;

class Calories extends Component
{
    public $todayCal, $user_id, $weight, $activity, $gender;
    public $isOpen = 0;

    public function render()
    {
        $this->todayCal = Calorie::where('user_id', auth()->user()->id)
                                 ->first();

        return view('livewire.calories');
    }

    public function count()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->weight = '';
        $this->activity = '';
        $this->gender = '';
    }

    public function store() {
        $this->validate([
            'weight' => 'required',
            'activity' => 'required',
            'gender' => 'required'
        ]);

        //Calories Calculation
        $fat = 0;
        $temp = $this->weight * 0.2;
        $temp = intval($temp);

        if($this->gender == "1") {
            if($temp >= 10 && $temp <= 14) {
                $fat = 1;
            }elseif($temp >= 15 && $temp <= 20) {
                $fat = 0.95;
            }elseif($temp >= 21 && $temp <= 28) {
                $fat = 0.9;
            }elseif($temp > 28) {
                $fat = 0.85;
            }
        }else{
            if($temp >= 14 && $temp <= 18) {
                $fat = 1;
            }elseif($temp >= 19 && $temp <= 28) {
                $fat = 0.95;
            }elseif($temp >= 29 && $temp <= 38) {
                $fat = 0.9;
            }elseif($temp > 38) {
                $fat = 0.85;
            }
        }

        $needs = $this->weight * $this->gender * 24 * $fat * $this->activity;
        //Calculation End
        
        $newCal = new Calorie;

        $newCal->user_id = auth()->user()->id;
        $newCal->weight = $this->weight;
        $newCal->multiplier = $this->activity;
        $newCal->gender = $this->gender;
        $newCal->calories = $needs;

        $newCal->save();

        session()->flash('message', 'Calories Calculated Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function clear()
    {
        $myCal = Calorie::where('user_id', auth()->user()->id)
                        ->first()
                        ->delete();

        session()->flash('message', 'Calculation Resetted Successfully.');
    }
}
