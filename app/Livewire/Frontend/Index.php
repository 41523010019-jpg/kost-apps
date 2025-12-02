<?php

namespace App\Livewire\Frontend;

use App\Models\Room;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.home')]
class Index extends Component
{
    public function render()
    {
        $rooms = Room::with('photos')->get();

        return view('livewire.frontend.index', compact('rooms'));
    }
}
