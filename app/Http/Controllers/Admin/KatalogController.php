<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatOutdoor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{
    public function index()
    {

        $alat = AlatOutdoor::orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')
                        ->get();

        return view('admin.crud-katalog', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'  => 'required',
            'harga_sewa' => 'required|numeric',
            'is_active'  => 'required|boolean', // Validasi input is_active
            'foto_alat'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_alat')) {
            // DISINI PERUBAHANNYA: Langsung simpan ke folder 'foto_alat' dengan disk 'public'
            $fotoPath = $request->file('foto_alat')->store('foto_alat', 'public');
        }

        AlatOutdoor::create([
            'nama_alat'  => $request->nama_alat,
            'harga_sewa' => $request->harga_sewa,
            'is_active'  => $request->is_active, // Simpan status aktif/tidak
            'foto_alat'  => $fotoPath,
            'deskripsi'  => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Alat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $alat = AlatOutdoor::findOrFail($id);

        $request->validate([
            'nama_alat'  => 'required',
            'harga_sewa' => 'required|numeric',
            'is_active'  => 'required|boolean', // Validasi update is_active
            'foto_alat'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_alat')) {
            if ($alat->foto_alat) {
                // Hapus foto lama di disk public
                Storage::disk('public')->delete($alat->foto_alat);
            }
            // DISINI PERUBAHANNYA: Simpan foto baru ke disk 'public'
            $alat->foto_alat = $request->file('foto_alat')->store('foto_alat', 'public');
        }

        $alat->update([
            'nama_alat'  => $request->nama_alat,
            'harga_sewa' => $request->harga_sewa,
            'is_active'  => $request->is_active, // Update status aktif/tidak
            'deskripsi'  => $request->deskripsi,
            'foto_alat'  => $alat->foto_alat,
        ]);

        return redirect()->back()->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
    // Proses hapus dan pengurutan ID
    DB::transaction(function () use ($id) {

        // Cari data yang akan dihapus
        $alat = AlatOutdoor::findOrFail($id);

        // Hapus foto jika ada
        if ($alat->foto_alat) {
            Storage::disk('public')->delete($alat->foto_alat);
        }

        // Hapus data
        $alat->delete();

        // Ambil semua data yang tersisa
        $data = AlatOutdoor::orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $table = (new AlatOutdoor)->getTable();

        // ID sementara agar tidak bentrok
        $maxId = DB::table($table)->max('id') ?? 0;
        $offset = $maxId + 1000;

        // Pindahkan ID ke nomor sementara
        foreach ($data as $item) {
            DB::table($table)
                ->where('id', $item->id)
                ->update([
                    'id' => $item->id + $offset
                ]);
        }

        // Susun ulang ID menjadi 1, 2, 3, dst.
        $nomor = 1;

        foreach ($data as $item) {
            DB::table($table)
                ->where('id', $item->id + $offset)
                ->update([
                    'id' => $nomor
                ]);

            $nomor++;
        }
    });

    // ALTER TABLE diletakkan DI LUAR transaction
    $table = (new AlatOutdoor)->getTable();

    $nomor = AlatOutdoor::count() + 1;

    DB::statement(
        'ALTER TABLE ' . $table . ' AUTO_INCREMENT = ' . $nomor
    );

    return redirect()
        ->back()
        ->with('success', 'Alat berhasil dihapus dan ID diurutkan ulang!');
    }
}
