<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $bill->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2d2d2d;
            margin: 0;
            padding: 0;
            background: #f5f7fa;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 25px 0;
        }

        /* HEADER */
        .header {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e5e9f2;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.07);
            margin-bottom: 25px;
        }

        .header-left {
            float: left;
        }

        .header-left img {
            width: 70px;
            margin-bottom: 5px;
        }

        .header-title {
            float: right;
            text-align: right;
            font-size: 28px;
            font-weight: bold;
            color: #0A84FF;
            letter-spacing: 1px;
        }

        .clearfix {
            clear: both;
        }

        /* SECTION WRAPPER */
        .section {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e5e9f2;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .title-small {
            color: #7d8ca4;
            font-size: 11px;
            margin-bottom: 3px;
        }

        h3 {
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #1c1c1c;
        }

        /* BADGE */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            color: #fff;
            margin-top: 5px;
        }

        .paid {
            background: #28c76f;
        }

        .unpaid {
            background: #ea5455;
        }

        /* TABLE MODERN */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th {
            background: #0A84FF;
            color: white;
            padding: 12px;
            font-size: 12px;
            letter-spacing: 0.3px;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #eef0f4;
        }

        .table tr:nth-child(even) {
            background: #f9fbfd;
        }

        /* SUMMARY */
        .summary-table {
            width: 40%;
            float: right;
            margin-top: 20px;
        }

        .summary-table td {
            padding: 6px 0;
            font-size: 13px;
        }

        .total-text {
            font-weight: bold;
            border-top: 2px solid #0A84FF;
            padding-top: 8px;
            font-size: 15px;
            color: #0A84FF;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            font-size: 10px;
            color: #7c8799;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <div class="header-left">
                @php
                use App\Models\WebSetting;
                use App\Models\Contact;

                $websetting = WebSetting::first(); // Ambil data websetting aktif
                $contact = Contact::where('is_active', 1)->first(); // Ambil contact aktif
                @endphp

                <div style="font-size:14px; font-weight:bold; margin-top:5px;">
                    {{-- Nama Kost / Perusahaan --}}
                    {{ $websetting?->site_title ?? 'Nama Kost / Perusahaan' }}
                </div>

                <div style="font-size:11px;">
                    {{-- Alamat lengkap dari Contact --}}
                    {{ $contact?->address ?? 'Alamat tidak tersedia' }}
                    @if($contact?->address_note)
                    ({{ $contact->address_note }})
                    @endif
                </div>

                <div style="font-size:11px; margin-top:2px;">
                    {{-- Kontak tambahan --}}
                    @if($contact?->phone)
                    Telepon: {{ $contact->phone }}
                    @if($contact->phone_note) ({{ $contact->phone_note }}) @endif
                    @endif
                    @if($contact?->email)
                    | Email: {{ $contact->email }}
                    @endif
                </div>

            </div>

            <div class="header-title">
                INVOICE
            </div>

            <div class="clearfix"></div>
        </div>

        <!-- CLIENT & INVOICE INFO -->
        <div class="section">

            <div style="float:left; width:55%;">
                <div class="title-small">DIBUAT UNTUK</div>
                <h3>{{ $user->name }}</h3>
                <div>{{ $user->phone }}</div>
                <div>{{ $user->email }}</div>
                <div>{{ $room->name }}</div>
            </div>

            <div style="float:right; width:40%; text-align:right;">
                <div class="title-small">INVOICE #</div>
                <h3>{{ str_pad($bill->id, 6, '0', STR_PAD_LEFT) }}</h3>

                @php $isPaid = strtolower($bill->status) === 'paid'; @endphp
                <div class="title-small" style="margin-top:12px;">STATUS</div>

                <span class="status-badge {{ $isPaid ? 'paid' : 'unpaid' }}">
                    {{ $isPaid ? 'LUNAS' : 'BELUM LUNAS' }}
                </span>

                <div class="title-small" style="margin-top:14px;">TANGGAL TERBIT</div>
                <div>{{ now()->format('d M Y') }}</div>

                <div class="title-small" style="margin-top:14px;">PERIODE TAGIHAN</div>
                <div>{{ $bill->due_date->format('F Y') }}</div>
            </div>

            <div class="clearfix"></div>
        </div>

        <!-- TABLE -->
        <div class="section">
            <table class="table">
                <thead>
                    <tr>
                        <th>DESKRIPSI</th>
                        <th>HARGA</th>
                        <th>QTY</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Tagihan Kamar Bulanan - {{ $room->name }}</td>
                        <td>Rp {{ number_format($bill->amount,0,',','.') }}</td>
                        <td>1</td>
                        <td>Rp {{ number_format($bill->amount,0,',','.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- SUMMARY -->
        <div class="section" style="padding-bottom:5px;">
            <table class="summary-table">
                <tr>
                    <td>Subtotal</td>
                    <td style="text-align:right;">Rp {{ number_format($bill->amount,0,',','.') }}</td>
                </tr>
                <tr>
                    <td>Pajak</td>
                    <td style="text-align:right;">Rp 0</td>
                </tr>
                <tr class="total-text">
                    <td>Total</td>
                    <td style="text-align:right;">Rp {{ number_format($bill->amount,0,',','.') }}</td>
                </tr>
            </table>

            <div class="clearfix"></div>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            *Dokumen ini dibuat otomatis oleh sistem dan tidak memerlukan tanda tangan.
        </div>

    </div>

</body>

</html>