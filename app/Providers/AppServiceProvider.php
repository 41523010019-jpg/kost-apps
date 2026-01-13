<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use App\Models\Contact;
use App\Models\WebSetting;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /* =========================
         * Midtrans Config
         * ========================= */
        Config::$serverKey     = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');

        /* =========================
         * Global Data (Footer / Component)
         * ========================= */
        View::composer('*', function ($view) {
            $view->with([
                // Kontak aktif
                'contact' => Contact::active()->first(),

                // Web setting aktif
                'webSetting' => WebSetting::active()->first(),
            ]);
        });
    }
}
