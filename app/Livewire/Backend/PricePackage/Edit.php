<?php

namespace App\Livewire\Backend\PricePackage;

use App\Models\PricePackage;
use App\Models\Category;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $packageId;

    public $category_id;
    public $price_per_month;
    public $is_popular;
    public $facilities_text;

    public $categories = [];

    /** Load kategori di mount */
    public function mount()
    {
        $this->categories = Category::all();
    }

    #[On('edit-pricepackage')]
    public function edit($id)
    {
        $package = PricePackage::findOrFail($id);

        $this->packageId       = $package->id;
        $this->category_id     = $package->category_id;
        $this->price_per_month = $package->price_per_month;
        $this->is_popular      = $package->is_popular;

        // Convert array → textarea
        $this->facilities_text = implode("\n", $package->facilities ?? []);

        Flux::modal('edit-pricepackage')->show();
    }

    public function update()
    {
        $this->validate([
            'category_id'       => 'required|exists:categories,id',
            'price_per_month'   => 'required|numeric|min:0',
            'is_popular'        => 'required|boolean',
            'facilities_text'   => 'required|string',
        ]);

        // Convert textarea → array
        $facilities = array_filter(array_map('trim', explode("\n", $this->facilities_text)));

        $package = PricePackage::findOrFail($this->packageId);

        $package->update([
            'category_id'     => $this->category_id,
            'price_per_month' => $this->price_per_month,
            'is_popular'      => $this->is_popular,
            'facilities'      => $facilities,
        ]);

        session()->flash('success', 'Paket harga berhasil diperbarui.');

        Flux::modal('edit-pricepackage')->close();

        $this->reset();

        return $this->redirectRoute('dashboard.price-packages.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.price-package.edit');
    }
}
