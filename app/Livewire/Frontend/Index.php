<?php

namespace App\Livewire\Frontend;

use App\Models\Room;
use App\Models\PricePackage;
use App\Models\Hero;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.home')]
class Index extends Component
{
    public function render()
    {
        $rooms = Room::with('photos')->get();
        $packages = PricePackage::with('category')->get();
        $heroes = Hero::orderBy('order')->get();

        return view('livewire.frontend.index', compact('rooms', 'packages', 'heroes'));
    }
}
