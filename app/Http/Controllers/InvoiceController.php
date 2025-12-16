<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBill;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate(MonthlyBill $bill)
    {
        $booking = $bill->booking;
        $user = $booking->user;
        $room = $booking->room;

        $pdf = Pdf::loadView('invoice.bill', compact('bill', 'booking', 'user', 'room'))
                  ->setPaper('a4');

        return $pdf->download('invoice-'.$bill->id.'.pdf');
    }
}
