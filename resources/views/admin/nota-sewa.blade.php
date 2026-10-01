<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Sewa - {{ $transaction->transaction_number }}</title>
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body { font-family: 'Courier New', monospace; font-size: 13px; padding: 20px; }
        .nota-container { max-width: 320px; margin: 0 auto; border: 1px dashed #333; padding: 15px; }
        .nota-header { text-align: center; border-bottom: 1px dashed #333; padding-bottom: 10px; margin-bottom: 10px; }
        .nota-header h5 { margin: 0; font-weight: bold; }
        .nota-row { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .nota-divider { border-top: 1px dashed #333; margin: 10px 0; }
        .nota-total { font-weight: bold; font-size: 15px; }
        .nota-footer { text-align: center; margin-top: 15px; padding-top: 10px; border-top: 1px dashed #333; font-size: 11px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="nota-container">
        <div class="nota-header">
            <h5>GongSt</h5>
            <div>Dusun Jatigunung, Klenang Kidul, Kec. Banyuanyar, Probolinggo</div>
            <div>Telp: 0851-6312-5566</div>
        </div>

        <div class="nota-row"><span>No. Nota</span><span>{{ $transaction->transaction_number }}</span></div>
        <div class="nota-row"><span>Tanggal</span><span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span></div>
        <div class="nota-row"><span>Kasir</span><span>{{ $transaction->user->name ?? 'Admin' }}</span></div>
        <div class="nota-row"><span>Penyewa</span><span>{{ $transaction->customer_type }}</span></div>
        @if($transaction->customer_identity)
            <div class="nota-row"><span>No. Identitas</span><span>{{ $transaction->customer_identity }}</span></div>
        @endif

        <div class="nota-divider"></div>

        <div><strong>DAFTAR SEWA:</strong></div>
        @foreach($transaction->details as $detail)
            <div style="margin-top: 6px;">
                <div>{{ $detail->product_name }}</div>
                <div class="nota-row">
                    <span>{{ $detail->qty }} hari x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach

        <div class="nota-divider"></div>

        <div class="nota-row"><span>Subtotal</span><span>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span></div>
        @if($transaction->discount_amount > 0 || $transaction->discount_percent > 0)
            <div class="nota-row"><span>Diskon</span><span>- Rp {{ number_format($transaction->discount_amount + ($transaction->subtotal * $transaction->discount_percent / 100), 0, ',', '.') }}</span></div>
        @endif
        @if($transaction->jaminan > 0)
            <div class="nota-row"><span>Jaminan</span><span>Rp {{ number_format($transaction->jaminan, 0, ',', '.') }}</span></div>
        @endif
        @if($transaction->other_fee > 0)
            <div class="nota-row"><span>Biaya Lain</span><span>Rp {{ number_format($transaction->other_fee, 0, ',', '.') }}</span></div>
        @endif

        <div class="nota-divider"></div>
        <div class="nota-row nota-total"><span>TOTAL</span><span>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span></div>
        <div class="nota-row"><span>Bayar ({{ $transaction->payment_method }})</span><span>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span></div>
        <div class="nota-row"><span>Kembali</span><span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span></div>

        <div class="nota-footer">
            <div>*** TERIMA KASIH ***</div>
            <div>Barang yang disewa harap dikembalikan tepat waktu.</div>
            <div>Kerusakan/kehilangan menjadi tanggung jawab penyewa.</div>
        </div>
    </div>

    <div class="text-center mt-3 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-sm">🖨️ Cetak Ulang</button>
        <a href="{{ route('admin.kasir') }}" class="btn btn-secondary btn-sm">Kembali ke Kasir</a>
    </div>

</body>
</html>
