<div class="relative mb-6 w-full">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">Payment Gateway</flux:heading>
            <flux:subheading size="lg">
                Kelola konfigurasi pembayaran Midtrans
            </flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">
                    Home
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    System
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Payment Gateway
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- SUCCESS MESSAGE --}}
    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
            role="alert"
        >
            {{ session('success') }}
        </div>
    @endif

    {{-- CENTERED FORM --}}
    <div class="mt-12 flex justify-center">
        <div class="w-full max-w-xl space-y-6 rounded-xl border border-gray-200 dark:border-neutral-700
                    bg-white dark:bg-neutral-900 p-6 shadow-md">

            {{-- SERVER KEY --}}
            <div>
                <flux:label>
                    Midtrans Server Key
                </flux:label>

                <flux:input
                    type="password"
                    wire:model.defer="server_key"
                    placeholder="SB-Mid-server-xxxx"
                />

                @error('server_key')
                    <flux:text class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </flux:text>
                @enderror
            </div>

            {{-- CLIENT KEY --}}
            <div>
                <flux:label>
                    Midtrans Client Key
                </flux:label>

                <flux:input
                    type="text"
                    wire:model.defer="client_key"
                    placeholder="SB-Mid-client-xxxx"
                />

                @error('client_key')
                    <flux:text class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </flux:text>
                @enderror
            </div>

            {{-- PRODUCTION MODE --}}
            <div class="flex items-center gap-3">
                <flux:checkbox wire:model="is_production" />
                <flux:text>
                    Production Mode
                </flux:text>
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end pt-4">
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="save">
                    Simpan Perubahan
                </flux:button>
            </div>
        </div>
    </div>
</div>
