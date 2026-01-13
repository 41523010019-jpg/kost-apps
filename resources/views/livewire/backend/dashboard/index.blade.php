<div class="flex flex-col gap-6 w-full">
    @role('admin')
    {{-- Section: Statistik Utama --}}
    <div class="grid gap-6 md:grid-cols-3">
        @php
        $cards = [
            [
                'label' => 'Jumlah Pengguna',
                'value' => $jumlahPengguna,
                'color' => 'from-blue-400 to-blue-600',
                'icon' => 'user-group',
            ],
            [
                'label' => 'Jumlah Booking',
                'value' => $jumlahBooking,
                'color' => 'from-indigo-400 to-indigo-600',
                'icon' => 'folder',
            ],
            [
                'label' => 'Booking Lunas',
                'value' => $jumlahLunas,
                'color' => 'from-green-400 to-green-600',
                'icon' => 'check-circle',
            ],
        ];
        @endphp

        @foreach ($cards as $card)
        <div class="flex flex-col justify-between rounded-3xl p-6 shadow-lg bg-gradient-to-r {{ $card['color'] }} text-white hover:scale-[1.03] transition-transform duration-300">
            <div class="flex items-center gap-3 text-sm opacity-90 mb-2">
                <x-icon name="{{ $card['icon'] }}" class="w-6 h-6" />
                <span>{{ $card['label'] }}</span>
            </div>
            <div class="text-4xl font-bold">{{ $card['value'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Section: Statistik Harian --}}
    <div class="grid gap-6 md:grid-cols-3 mt-4">
        @php
        $dailyStats = [
            [
                'label' => 'Booking Hari Ini',
                'value' => $jumlahHariIni,
                'icon' => 'calendar-days',
                'bg' => 'bg-amber-100 dark:bg-amber-800',
                'text' => 'text-amber-700 dark:text-amber-200',
            ],
            [
                'label' => 'Lunas Hari Ini',
                'value' => $lunasHariIni,
                'icon' => 'check',
                'bg' => 'bg-emerald-100 dark:bg-emerald-800',
                'text' => 'text-emerald-700 dark:text-emerald-200',
            ],
            [
                'label' => 'Total Booking Bulan Ini',
                'value' => $totalBulanIni,
                'icon' => 'inbox',
                'bg' => 'bg-sky-100 dark:bg-sky-800',
                'text' => 'text-sky-700 dark:text-sky-200',
            ],
        ];
        @endphp

        @foreach ($dailyStats as $stat)
        <div class="flex items-center gap-4 p-5 bg-white dark:bg-neutral-900 rounded-2xl shadow hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-neutral-700">
            <div class="p-3 rounded-full {{ $stat['bg'] }}">
                <x-icon name="{{ $stat['icon'] }}" class="w-6 h-6 {{ $stat['text'] }}" />
            </div>
            <div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</div>
                <div class="text-xl font-semibold {{ $stat['text'] }}">{{ $stat['value'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Section: Tabel Booking Terbaru --}}
    <div class="bg-white dark:bg-neutral-900 shadow-lg rounded-3xl border border-gray-100 dark:border-neutral-700 overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-100 dark:border-neutral-700 font-semibold text-lg text-gray-700 dark:text-gray-100 flex items-center justify-between">
            <span>Booking Terbaru</span>
            <a href="{{ route('dashboard.bookings.index') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400" wire:navigate>
                Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-100 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800 text-gray-500 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Pemesan</th>
                        <th class="px-6 py-3 text-left">Kamar</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-900 divide-y divide-gray-100 dark:divide-neutral-700">
                    @forelse ($recentBookings as $booking)
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                        <td class="px-6 py-3 font-medium text-gray-800 dark:text-white whitespace-nowrap">{{ $booking->user->name }}</td>
                        <td class="px-6 py-3 text-gray-700 dark:text-gray-300">{{ $booking->room->name ?? '-' }}</td>
                        <td class="px-6 py-3">
                            @switch($booking->status)
                                @case('paid')
                                    <span class="px-3 py-1 text-green-700 bg-green-100 rounded-full text-xs font-semibold">Lunas</span>
                                    @break
                                @case('expired')
                                    <span class="px-3 py-1 text-red-700 bg-red-100 rounded-full text-xs font-semibold">Batal</span>
                                    @break
                                @default
                                    <span class="px-3 py-1 text-yellow-700 bg-yellow-100 rounded-full text-xs font-semibold">Pending</span>
                            @endswitch
                        </td>
                        <td class="px-6 py-3 text-gray-500 dark:text-gray-400">{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Belum ada booking</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @else
    {{-- View untuk Non-Admin --}}
    <div class="bg-white dark:bg-neutral-900 rounded-3xl shadow-lg p-6 border border-gray-100 dark:border-neutral-700">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Selamat Datang, {{ auth()->user()->name }}</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-2">Anda dapat melakukan booking kamar melalui halaman home dan rooms.</p>
        <p class="text-gray-600 dark:text-gray-300">Mohon lengkapi data diri dan pastikan semua informasi sudah benar sebelum melakukan booking.</p>
    </div>
    @endrole
</div>
