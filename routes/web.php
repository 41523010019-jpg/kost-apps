<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentWebhookController;
use App\Livewire\Backend\About\Index as AboutIndex;
use App\Livewire\Backend\Booking\Index as BookingIndex;
use App\Livewire\Backend\Category\Index as CategoryIndex;
use App\Livewire\Backend\Hero\Index as HeroIndex;
use App\Livewire\Backend\PaymentGateway\Index as PaymentGatewayIndex;
use App\Livewire\Backend\PricePackage\Index;
use App\Livewire\Backend\Room\Index as RoomIndex;
use App\Livewire\Frontend\Index as FrontendIndex;
use App\Livewire\Frontend\Room\Index as FrontendRoomIndex;
use App\Livewire\Frontend\Room\Show;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;


Route::post('/midtrans/webhook', [PaymentWebhookController::class, 'handle'])->name('midtrans.webhook');
Route::get('/invoice/{bill}', [InvoiceController::class, 'generate'])
    ->name('invoice.generate');


Route::get('/', FrontendIndex::class)->name('home');
Route::get('/rooms', FrontendRoomIndex::class)->name('rooms.index');
Route::get('/rooms/{room}', Show::class)->name('rooms.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Semua route dalam dashboard → prefix "dashboard"
Route::prefix('dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.')
    ->group(function () {
        Route::get('categories', CategoryIndex::class)->name('categories.index');
        Route::get('rooms', RoomIndex::class)->name('rooms.index');
        Route::get('price-packages', Index::class)->name('price-packages.index');
        Route::get('heroes', HeroIndex::class)->name('heroes.index');
        Route::get('bookings', BookingIndex::class)->name('bookings.index');
        Route::get('payment-gateway', PaymentGatewayIndex::class)->name('payment-gateway.index');
        Route::get('about', AboutIndex::class)->name('about.index');
    });

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
