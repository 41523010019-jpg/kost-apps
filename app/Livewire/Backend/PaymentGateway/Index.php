<?php

namespace App\Livewire\Backend\PaymentGateway;

use Livewire\Component;
use App\Models\PaymentGateway;
use App\Services\MidtransConfig;

class Index extends Component
{
    public $server_key;
    public $client_key;
    public $is_production = false;

    protected $rules = [
        'server_key'    => 'required|string',
        'client_key'    => 'required|string',
        'is_production' => 'boolean',
    ];

    public function mount()
    {
        $config = MidtransConfig::get();

        $this->server_key    = $config['server_key'];
        $this->client_key    = $config['client_key'];
        $this->is_production = $config['is_production'];
    }

    public function save()
    {
        $this->validate();

        PaymentGateway::setValue('midtrans', 'MIDTRANS_SERVER_KEY', $this->server_key);
        PaymentGateway::setValue('midtrans', 'MIDTRANS_CLIENT_KEY', $this->client_key);
        PaymentGateway::setValue('midtrans', 'MIDTRANS_IS_PRODUCTION', $this->is_production);

        MidtransConfig::clearCache();

        session()->flash('success', 'Konfigurasi Midtrans berhasil diperbarui');
    }

    public function render()
    {
        return view('livewire.backend.payment-gateway.index');
    }
}
