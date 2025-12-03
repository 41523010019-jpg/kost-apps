<?php

namespace App\Livewire\Backend\PricePackage;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PricePackage;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $packageId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-pricepackage', $id); 
    }

    /**
     * Open delete modal
     */
    public function delete($id)
    {
        $this->packageId = $id;
        Flux::modal('delete-pricepackage')->show();
    }

    /**
     * Delete action
     */
    public function deletePackage()
    {
        $package = PricePackage::findOrFail($this->packageId);
        $package->delete();

        Flux::modal('delete-pricepackage')->close();
        session()->flash('success', 'Paket harga berhasil dihapus.');
    }

    #[Title('Daftar Paket Harga')]
    public function render()
    {
        $packages = PricePackage::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.price-package.index', [
            'packages' => $packages,
        ]);
    }
}
