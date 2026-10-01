<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatOutdoor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    /**
     * Tampilkan halaman kasir + ambil alat dari database.
     */
    public function index()
    {
        $products = AlatOutdoor::where('is_active', 1)
            ->get()
            ->map(function ($item) {
                return [
                    'id'    => $item->id,
                    'code'  => 'ALT' . str_pad($item->id, 3, '0', STR_PAD_LEFT),
                    'name'  => $item->nama_alat,
                    'price' => (float) $item->harga_sewa,
                ];
            });

        return view('admin.kasir', compact('products'));
    }

    /**
     * Simpan transaksi sewa ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_type'     => 'required|string',
            'customer_identity' => 'nullable|string',
            'payment_method'    => 'required|string',
            'paid_amount'       => 'required|numeric|min:0',
            'items'             => 'required|array|min:1',
            'items.*.id'        => 'required|exists:alat_outdoors,id',
            'items.*.qty'       => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            $itemsData = [];

            foreach ($request->items as $item) {
                $alat = AlatOutdoor::findOrFail($item['id']);
                $itemSubtotal = $alat->harga_sewa * $item['qty'];
                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'product_id'   => $alat->id,
                    'product_code' => 'ALT' . str_pad($alat->id, 3, '0', STR_PAD_LEFT),
                    'product_name' => $alat->nama_alat,
                    'price'        => $alat->harga_sewa,
                    'qty'          => $item['qty'],
                    'subtotal'     => $itemSubtotal,
                ];
            }

            $discountPercent = $request->discount_percent ?? 0;
            $discountAmount  = $request->discount_amount ?? 0;
            $jaminan         = $request->jaminan ?? 0;
            $otherFee        = $request->other_fee ?? 0;

            $percentDiscount = $subtotal * ($discountPercent / 100);
            $totalDiscount   = $percentDiscount + $discountAmount;
            $grandTotal      = max(0, $subtotal - $totalDiscount + $jaminan + $otherFee);

            $paidAmount   = $request->paid_amount;
            $changeAmount = $paidAmount - $grandTotal;

            if ($paidAmount < $grandTotal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Uang pembayaran masih kurang.',
                ], 422);
            }

            // Generate nomor transaksi
            $trxNumber = 'INV-' . date('Ymd') . '-' . str_pad(
                Transaction::whereDate('created_at', today())->count() + 1,
                3, '0', STR_PAD_LEFT
            );

            $transaction = Transaction::create([
                'transaction_number' => $trxNumber,
                'user_id' => Auth::id(),
                'customer_type'      => $request->customer_type,
                'customer_identity'  => $request->customer_identity,
                'rental_date'        => now(),
                'return_date'        => now()->addDays(collect($request->items)->max('qty')),
                'subtotal'           => $subtotal,
                'discount_percent'   => $discountPercent,
                'discount_amount'    => $discountAmount,
                'jaminan'            => $jaminan,
                'other_fee'          => $otherFee,
                'grand_total'        => $grandTotal,
                'paid_amount'        => $paidAmount,
                'change_amount'      => $changeAmount,
                'payment_method'     => $request->payment_method,
                'status'             => 'paid',
            ]);

            foreach ($itemsData as $detail) {
                $transaction->details()->create($detail);
            }

            DB::commit();

            return response()->json([
                'success'            => true,
                'message'            => 'Transaksi berhasil disimpan.',
                'transaction_id'     => $transaction->id,
                'transaction_number' => $transaction->transaction_number,
                'print_url'          => route('admin.kasir.nota', $transaction->id),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Tampilkan nota untuk dicetak.
     */
    public function nota($id)
    {
        $transaction = Transaction::with('details', 'user')->findOrFail($id);
        return view('admin.nota-sewa', compact('transaction'));
    }
}
