<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Food;

class Foods extends Component
{
    use WithFileUploads;

    public $foods, $food_id, $user_id, $photo, $title, $slug, $body, $location, $price, $status, $calories;
    public $isOpen = 0;
    public $isEdit = 0;

    public function render()
    {
        $this->foods = Food::where('user_id', auth()->user()->id)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('livewire.foods');
    }

    public function create()
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

    public function openEdit()
    {
        $this->isEdit = true;
    }

    public function closeEdit()
    {
        $this->isEdit = false;
    }

    private function resetInputFields(){
        $this->food_id = '';
        $this->user_id = '';
        $this->photo = '';
        $this->title = '';
        $this->slug = '';
        $this->body = '';
        $this->location = '';
        $this->price = '';
        $this->status = '';
        $this->calories = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'location' => 'required',
            'price' => 'required',
            'status' => 'required',
            'calories' => 'required'
        ]);

        $lower_title = strtolower($this->title);
        $lower_name = strtolower(auth()->user()->name);
        $username = str_replace(" ", "-", $lower_name);
        $slug = str_replace(" ", "-", $lower_title) . '-' . 'by' . '-' . $username;

        if(empty($this->food_id)) {
            $this->validate([
                'photo' => 'required'
            ]);

            $photo_name = time(). '-' .auth()->user()->id . '.' . $this->photo->extension();
            $this->photo->storeAs('./public/foods', $photo_name);
            $photo_url = 'storage/foods/' . $photo_name;

            Food::updateOrCreate(['id' => $this->food_id], [
                'user_id' => auth()->user()->id,
                'photo' => $photo_url,
                'title' => $this->title,
                'slug' => $slug,
                'body' => $this->body,
                'location' => $this->location,
                'price' => $this->price,
                'status' => $this->status,
                'calories' => $this->calories
            ]);
        }else{
            Food::updateOrCreate(['id' => $this->food_id], [
                'user_id' => auth()->user()->id,
                'title' => $this->title,
                'slug' => $slug,
                'body' => $this->body,
                'location' => $this->location,
                'price' => $this->price,
                'status' => $this->status,
                'calories' => $this->calories
            ]);
        }
  
        session()->flash('message', $this->food_id ? 'Food Updated Successfully.' : 'Food Added Successfully.');
  
        $this->closeModal();
        $this->closeEdit();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $this->food_id = $id;
        $this->title = $food->title;
        $this->body = $food->body;
        $this->location = $food->location;
        $this->price = $food->price;
        $this->status = $food->status;
        $this->calories = $food->calories;
    
        $this->openEdit();
    }

    public function delete($id)
    {
        Food::find($id)->delete();
        session()->flash('message', 'Food Deleted Successfully.');
    }
}
