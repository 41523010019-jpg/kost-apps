<?php

namespace App\Livewire\Backend\PricePackage;

use App\Models\Category;
use App\Models\PricePackage;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $category_id;
    public $price_per_month;
    public $facilities_text = ''; // input textarea
    public $facilities = [];      // array hasil konversi
    public $is_popular = false;

    protected $rules = [
        'category_id'      => 'required|exists:categories,id',
        'price_per_month'  => 'required|numeric|min:0',
        'facilities_text'  => 'nullable|string',
        'is_popular'       => 'boolean',
    ];

    public function save()
    {
        // Convert textarea -> array
        $this->facilities = array_filter(array_map(
            'trim',
            explode("\n", $this->facilities_text)
        ));

        // Validasi setelah konversi
        $this->validate([
            'category_id'      => 'required|exists:categories,id',
            'price_per_month'  => 'required|numeric|min:0',
            'facilities'       => 'nullable|array',
            'is_popular'       => 'boolean',
        ]);

        PricePackage::create([
            'category_id'     => $this->category_id,
            'price_per_month' => $this->price_per_month,
            'facilities'      => $this->facilities, // array JSON
            'is_popular'      => $this->is_popular,
        ]);

        // Reset form
        $this->reset(['category_id', 'price_per_month', 'facilities_text', 'facilities', 'is_popular']);

        // Tutup modal & notifikasi
        Flux::modal('create-pricepackage')->close();
        session()->flash('success', 'Paket harga berhasil ditambahkan.');

        $this->redirectRoute('dashboard.price-packages.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.price-package.create', [
            'categories' => Category::all(),
        ]);
    }
}
