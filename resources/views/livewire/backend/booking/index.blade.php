<div class="relative mb-6 w-full">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <flux:heading size="xl" level="1">Booking</flux:heading>
            <flux:subheading size="lg">Daftar booking & tagihan Anda</flux:subheading>
        </div>

        <div class="flex justify-start md:justify-end">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" separator="slash">Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="#" separator="slash">Transaksi</flux:breadcrumbs.item>
                <flux:breadcrumbs.item separator="slash">Booking</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Tabel Booking --}}
    <div class="mt-8 overflow-x-auto">
        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg">

                {{-- Header Tabel --}}
                <thead class="bg-gray-50 dark:bg-neutral-900 text-gray-700 dark:text-gray-100 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Kamar</th>
                        <th class="px-6 py-3 text-left">Mulai</th>
                        <th class="px-6 py-3 text-left">Tagihan</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Pembayaran</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Body Tabel --}}
                <tbody class="bg-white dark:bg-neutral-950 divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($bookings as $index => $booking)
                    @foreach ($booking->bills as $bill)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            {{ $booking->user->name }}
                        </td>

                        {{-- Nama Kamar --}}
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            {{ $booking->room->name }}
                        </td>

                        {{-- Tanggal Mulai --}}
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">
                            {{ $booking->start_date->format('d M Y') }}
                        </td>

                        {{-- Tagihan --}}
                        <td class="px-6 py-4 text-sm">
                            <p>Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                            <span class="text-xs text-gray-500">
                                Jatuh Tempo: {{ $bill->due_date->format('d M Y') }}
                            </span>
                        </td>

                        {{-- Status Tagihan --}}
                        <td class="px-6 py-4 text-sm">
                            @if ($bill->status == 'paid')
                            <span class="text-green-600 font-medium">Lunas</span>
                            @elseif ($bill->status == 'pending')
                            <span class="text-yellow-600 font-medium">Pending</span>
                            @else
                            <span class="text-red-600 font-medium">Belum Bayar</span>
                            @endif
                        </td>

                        {{-- Status Pembayaran --}}
                        {{-- STATUS PEMBAYARAN --}}
                        <td class="px-6 py-4 text-sm">

                            {{-- SUDAH LUNAS --}}
                            @if ($bill->status === 'paid')
                            <p class="text-xs text-green-600 font-semibold">Settlement</p>

                            {{-- BELUM BAYAR & BELUM ADA PAYMENT --}}
                            @elseif (!$bill->payment)
                            <button
                                wire:click="generateSnapToken({{ $bill->id }})"
                                class="text-blue-600 text-xs underline">
                                Bayar
                            </button>

                            {{-- ADA PAYMENT --}}
                            @else
                            <p class="font-medium">{{ strtoupper($bill->payment->method) }}</p>

                            @php $status = $bill->payment->transaction_status; @endphp

                            {{-- MIDTRANS --}}
                            @if ($bill->payment->method === 'midtrans')
                            @if ($status === 'pending')
                            <button
                                wire:click="$dispatch('payAgain', { token: '{{ $bill->payment->snap_token }}' })"
                                class="text-blue-600 text-xs underline">
                                Bayar Sekarang
                            </button>
                            @elseif (in_array($status, ['settlement', 'success']))
                            <p class="text-xs text-green-600">Settlement</p>
                            @else
                            <p class="text-xs text-gray-500">{{ ucfirst($status) }}</p>
                            @endif

                            {{-- CASH --}}
                            @else
                            @if ($status === 'pending')
                            <span class="text-gray-600 text-xs">Menunggu konfirmasi admin</span>
                            @else
                            <p class="text-xs text-green-600">{{ ucfirst($status) }}</p>
                            @endif
                            @endif
                            @endif
                        </td>



                        {{-- Aksi --}}
                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-center space-x-3">

                            {{-- Invoice --}}
                            <a href="{{ route('invoice.generate', $bill->id) }}"
                                class="text-green-600 hover:text-green-800 text-sm underline">
                                Invoice
                            </a>

                            {{-- Admin konfirmasi cash --}}
                            @role('admin')
                            @if ($bill->payment && $bill->payment->method === 'cash' && $bill->payment->transaction_status === 'pending')
                            <button
                                wire:click="markAsPaidCash({{ $bill->id }})"
                                class="text-blue-600 hover:text-blue-800 text-sm underline"
                                onclick="return confirm('Konfirmasi pembayaran cash ini?')">
                                Konfirmasi
                            </button>
                            @endif
                            @endrole

                            {{-- Delete --}}
                            @role('admin')
                            <button
                                wire:click="deleteBill({{ $bill->id }})"
                                class="text-red-600 hover:text-red-800 text-sm underline"
                                onclick="return confirm('Yakin ingin menghapus tagihan ini?')">
                                Delete
                            </button>
                            @endrole
                        </td>



                    </tr>
                    @endforeach
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada booking.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</div>

{{-- Listener Midtrans Snap --}}
<script>
    document.addEventListener('payAgain', function(event) {
        const token = event.detail.token;
        console.log("Snap Token diterima:", token);

        window.snap.pay(token, {
            onSuccess: function(result) {
                console.log("Pembayaran berhasil:", result);
                Livewire.emit('paymentUpdated', result.order_id);
                alert('Pembayaran berhasil!');
            },
            onPending: function(result) {
                console.log("Pembayaran pending:", result);
                Livewire.emit('paymentUpdated', result.order_id);
                alert('Pembayaran masih pending, silakan selesaikan.');
            },
            onError: function(result) {
                console.log("Terjadi error:", result);
                alert('Terjadi kesalahan saat pembayaran.');
            },
            onClose: function() {
                console.log("Popup ditutup tanpa bayar.");
            }
        });
    });
</script>