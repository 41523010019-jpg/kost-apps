<?php

namespace App\Exports;

use App\Models\Booking;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BookingReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected ?string $from;
    protected ?string $to;
    protected ?int $month;
    protected ?int $year;
    protected ?string $status;

    public function __construct(
        ?string $from = null,
        ?string $to = null,
        ?int $month = null,
        ?int $year = null,
        ?string $status = null
    ) {
        $this->from   = $from;
        $this->to     = $to;
        $this->month  = $month;
        $this->year   = $year;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Booking::with([
            'user',
            'room.category',
            'payments'
        ]);

        // PRIORITAS FILTER
        if ($this->from && $this->to) {
            $query->whereBetween('start_date', [
                Carbon::parse($this->from)->startOfDay(),
                Carbon::parse($this->to)->endOfDay(),
            ]);
        } elseif ($this->month && $this->year) {
            $query->whereMonth('start_date', $this->month)
                  ->whereYear('start_date', $this->year);
        } elseif ($this->year) {
            $query->whereYear('start_date', $this->year);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID Booking',
            'Nama User',
            'Email',
            'Telepon',
            'Nama Kamar',
            'Kategori Kamar',
            'Harga Kamar',
            'Tanggal Mulai',
            'Next Billing',
            'Status Booking',
            'Total Pembayaran',
            'Metode Pembayaran',
            'Status Transaksi',
            'Tanggal Bayar',
        ];
    }

    public function map($booking): array
    {
        $payment = $booking->payments->last();

        return [
            $booking->id,
            $booking->user?->name ?? '-',
            $booking->user?->email ?? '-',
            $booking->user?->phone ?? '-',
            $booking->room?->name ?? '-',
            $booking->room?->category?->name ?? '-',
            $booking->room?->price ?? 0,
            optional($booking->start_date)->format('d-m-Y'),
            optional($booking->next_billing_date)->format('d-m-Y'),
            ucfirst($booking->status),
            $payment?->amount ?? 0,
            $payment?->method ?? '-',
            $payment?->transaction_status ?? '-',
            optional($payment?->created_at)->format('d-m-Y H:i'),
        ];
    }

    /**
     * Styling header dan rows
     */
    public function styles(Worksheet $sheet)
    {
        // Header styling
        $sheet->getStyle('A1:N1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF1E40AF'], // warna biru modern
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Border untuk semua cell
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:N'.$highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ]);

        // Alternating row colors
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A'.$row.':N'.$row)->getFill()
                      ->setFillType(Fill::FILL_SOLID)
                      ->getStartColor()->setARGB('FFF3F4F6'); // abu-abu terang
            }
        }
    }
}
