<?php

namespace App\Livewire\Backend\WebSetting;

use App\Models\WebSetting;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $webSettingId;

    public $site_title;
    public $site_description;
    public $social_media = [];
    public $copyright;
    public $is_active = true;

    #[On('edit-web-setting')]
    public function edit($id)
    {
        $webSetting = WebSetting::findOrFail($id);

        $this->webSettingId      = $webSetting->id;
        $this->site_title        = $webSetting->site_title;
        $this->site_description  = $webSetting->site_description;
        $this->social_media      = $webSetting->social_media ?? [];
        $this->copyright         = $webSetting->copyright;
        $this->is_active         = $webSetting->is_active;

        Flux::modal('edit-web-setting')->show();
    }

    public function update()
    {
        $this->validate([
            'site_title'        => 'required|string|max:150',
            'site_description'  => 'nullable|string',
            'social_media'      => 'nullable|array',
            'copyright'         => 'nullable|string|max:150',
            'is_active'         => 'boolean',
        ]);

        $webSetting = WebSetting::findOrFail($this->webSettingId);

        /**
         * Pastikan hanya satu WebSetting yang aktif
         */
        if ($this->is_active) {
            WebSetting::where('id', '!=', $webSetting->id)
                ->update(['is_active' => false]);
        }

        $webSetting->update([
            'site_title'        => $this->site_title,
            'site_description'  => $this->site_description,
            'social_media'      => $this->social_media,
            'copyright'         => $this->copyright,
            'is_active'         => $this->is_active,
        ]);

        session()->flash('success', 'Web Setting berhasil diperbarui.');

        Flux::modal('edit-web-setting')->close();

        $this->reset();

        $this->redirectRoute('dashboard.web-setting.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.backend.web-setting.edit');
    }
}
