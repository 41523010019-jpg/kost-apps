<?php

namespace App\Http\Controllers;

use App\Exports\BookingReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookingReportController extends Controller
{
    /**
     * Export laporan booking ke Excel
     * Support:
     * - Range date (from - to)
     * - Bulan + Tahun
     * - Tahun
     * - Status (optional)
     */
    public function export(Request $request)
    {
        // (Optional) Validasi ringan
        $request->validate([
            'from'   => 'nullable|date',
            'to'     => 'nullable|date|after_or_equal:from',
            'month'  => 'nullable|integer|min:1|max:12',
            'year'   => 'nullable|integer|min:2000|max:' . now()->year,
            'status' => 'nullable|string',
        ]);

        return Excel::download(
            new BookingReportExport(
                $request->from,
                $request->to,
                $request->month,
                $request->year,
                $request->status
            ),
            'laporan-booking-' . now()->format('d-m-Y') . '.xlsx'
        );
    }
}
