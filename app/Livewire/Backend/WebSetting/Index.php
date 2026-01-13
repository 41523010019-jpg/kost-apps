<?php

namespace App\Livewire\Backend\WebSetting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WebSetting;
use Flux\Flux;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $webSettingId;

    /**
     * Trigger edit modal
     */
    public function edit($id)
    {
        $this->dispatch('edit-web-setting', $id);
    }

    /**
     * Buka modal delete
     */
    public function delete($id)
    {
        $this->webSettingId = $id;
        Flux::modal('delete-web-setting')->show();
    }

    /**
     * Hapus data web setting
     */
    public function deleteWebSetting()
    {
        $setting = WebSetting::findOrFail($this->webSettingId);
        $setting->delete();

        Flux::modal('delete-web-setting')->close();
        session()->flash('success', 'Web Setting berhasil dihapus.');
    }

    #[Title('Pengaturan Website')]
    public function render()
    {
        $settings = WebSetting::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.backend.web-setting.index', [
            'settings' => $settings,
        ]);
    }
}
