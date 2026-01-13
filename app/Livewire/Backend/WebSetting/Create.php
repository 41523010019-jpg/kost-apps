<?php

namespace App\Livewire\Backend\WebSetting;

use App\Models\WebSetting;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $site_title = '';
    public $site_description = '';
    public $social_media = []; // array (JSON)
    public $copyright = '';
    public $is_active = true;

    protected $rules = [
        'site_title'        => 'required|string|max:150',
        'site_description'  => 'nullable|string',
        'social_media'      => 'nullable|array',
        'copyright'         => 'nullable|string|max:255',
        'is_active'         => 'boolean',
    ];

    public function save()
    {
        $decoded = json_decode($this->social_media, true);

        if (!is_array($decoded)) {
            $this->addError('social_media', 'Format JSON tidak valid.');
            return;
        }

        WebSetting::create([
            'site_title'       => $this->site_title,
            'site_description' => $this->site_description,
            'social_media'     => $decoded,
            'copyright'        => $this->copyright,
            'is_active'        => $this->is_active,
        ]);

        $this->reset();
        Flux::modal('create-web-setting')->close();
        session()->flash('success', 'Web setting berhasil disimpan.');
    }


    public function render()
    {
        return view('livewire.backend.web-setting.create');
    }
}
