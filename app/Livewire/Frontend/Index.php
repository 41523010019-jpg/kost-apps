<?php

namespace App\Livewire\Frontend;

use App\Models\Room;
use App\Models\PricePackage;
use App\Models\Hero;
use App\Models\About;
use App\Models\Facility;
use App\Models\Contact;
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

        // Ambil 1 data About
        $about = About::first();

        // Ambil semua fasilitas
        $facilities = Facility::orderBy('created_at')->get();

        // Ambil 1 kontak aktif
        $contact = Contact::active()->first();

        return view('livewire.frontend.index', compact(
            'rooms',
            'packages',
            'heroes',
            'about',
            'facilities',
            'contact'
        ));
    }
}
