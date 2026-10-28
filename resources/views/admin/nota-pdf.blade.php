<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $transaction->transaction_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INVOICE PENYEWAAN ALAT OUTDOOR</h2>
        <p>No Transaksi: <strong>{{ $transaction->transaction_number }}</strong></p>
        <p>Tanggal Sewa: {{ \Carbon\Carbon::parse($transaction->rental_date)->format('d/m/Y') }}</p>
        <p>Pelanggan: {{ $transaction->customer_type }} ({{ $transaction->customer_identity ?? '-' }})</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total">Subtotal:</td>
                <td class="total">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="total">Diskon:</td>
                <td class="total">Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="total">Grand Total:</td>
                <td class="total">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
