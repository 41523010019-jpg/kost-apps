<div class="relative mb-6 w-full">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">
                {{ __('Export Laporan Booking') }}
            </flux:heading>
            <flux:subheading size="lg">
                {{ __('Unduh laporan booking berdasarkan range tanggal, bulan, atau tahun') }}
            </flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">
                    Home
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Booking
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">
                    Export
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- FORM FILTER --}}
    <form
        method="GET"
        action="{{ route('dashboard.booking.export') }}"
        class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Range Date --}}
        <div>
            <flux:label>Dari Tanggal</flux:label>
            <flux:input
                type="date"
                name="from"
                value="{{ request('from') }}" />
        </div>

        <div>
            <flux:label>Sampai Tanggal</flux:label>
            <flux:input
                type="date"
                name="to"
                value="{{ request('to') }}" />
        </div>

        {{-- Bulan --}}
        <div>
            <flux:label>Bulan</flux:label>
            <flux:select name="month">
                <option value="">-- Pilih Bulan --</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option
                        value="{{ $m }}"
                        @selected(request('month') == $m)>
                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                @endfor
            </flux:select>
        </div>

        {{-- Tahun --}}
        <div>
            <flux:label>Tahun</flux:label>
            <flux:select name="year">
                <option value="">-- Pilih Tahun --</option>
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option
                        value="{{ $y }}"
                        @selected(request('year') == $y)>
                        {{ $y }}
                    </option>
                @endfor
            </flux:select>
        </div>

        {{-- Status --}}
        <div>
            <flux:label>Status Booking</flux:label>
            <flux:select name="status">
                <option value="">Semua Status</option>
                <option value="active" @selected(request('status') === 'active')>Aktif</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Tidak Aktif</option>
                <option value="completed" @selected(request('status') === 'completed')>Selesai</option>
            </flux:select>
        </div>

        {{-- Tombol --}}
        <div class="flex items-end">
            <flux:button type="submit" variant="primary" class="w-full">
                Export Excel
            </flux:button>
        </div>
    </form>

    {{-- Info --}}
    <div class="mt-6 text-sm text-gray-500">
        <p>• Jika <strong>range tanggal</strong> diisi, maka filter bulan & tahun akan diabaikan.</p>
        <p>• Jika hanya memilih <strong>bulan & tahun</strong>, data akan difilter berdasarkan bulan tersebut.</p>
        <p>• Jika hanya memilih <strong>tahun</strong>, seluruh data tahun tersebut akan diexport.</p>
    </div>
</div>
