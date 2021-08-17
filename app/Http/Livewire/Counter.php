<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Counter extends Component
{
    public $search = '';

    public function render()
    {
      //  return view('livewire.counter');
        return view('livewire.counter', [
            'users' => User::where('name', $this->search)->get(),
        ]);
    }
}
