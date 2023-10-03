<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\Pendonor;
use App\Models\RiwayatAmbil;
use App\Models\RiwayatDonor;
use App\Models\StokDarah;
use Illuminate\Http\Request;

class StokDarahController extends Controller
{

    public $timestamps = true;

    public function index()
    {
        $data = StokDarah::all();
        $kode_pendonor = Pendonor::all();
        return view('partials.stokdarah', compact('data','kode_pendonor'));
    }

    // public function insertstok(Request $request)
    // {
    //     StokDarah::create($request->all());
    //     return redirect()->route('stokdarah');

    // }

    public function insertstok(Request $request)
    {
        $kode_pendonor = $request->input('kode_pendonor');
        $jumlah = $request->input('jumlah');

        // Cari data stok darah berdasarkan kode pendonor yang dipilih
        $findPendonor = Pendonor::where('kode_pendonor', $kode_pendonor)->first();
        $gol_darah = GolonganDarah::where('id',$findPendonor->id_golongan_darah)->first();
        $stokDarah = StokDarah::where('gol_darah', $gol_darah->id)->first();

        if ($stokDarah) {
            // Jika data stok darah dengan golongan darah yang sama sudah ada, tambahkan jumlahnya
            $stokDarah->jumlah += $jumlah;
            $stokDarah->save();

        } else {
            // Jika tidak ada data stok darah dengan golongan darah yang sama, buat entri baru
            $stokDarah = new StokDarah();
            $stokDarah->gol_darah = $gol_darah->id;
            $stokDarah->jumlah = $jumlah;
            $stokDarah->save();
        }

        //masukkan ke dalam riwayat donor
        RiwayatDonor::create([
            'pendonor_id' => $findPendonor->id,
            'jumlah_donor' => $jumlah,
            'tanggal_donor' => now()
        ]);

        // Setelah operasi insert atau update selesai, Anda dapat melakukan redirect
        return redirect()->route('stokdarah');
    }

    // public function updatestok(Request $request, $id)
    // {
    //     // Mengambil data berdasarkan $id
    //     $stokDarah = StokDarah::find($id);

    //     // Memperbarui data dengan nilai dari $request->all()
    //     $stokDarah->update($request->all());

    //     return redirect()->route('stokdarah');
    // }

    public function updatestok(Request $request)
    {
        $kode_pendonor = $request->input('kode_pendonor');
        $jumlah = $request->input('jumlah');
        $penerima = $request->input('penerima');
        $kontak_penerima = $request->input('kontak');

        // Cari data stok darah berdasarkan kode pendonor yang dipilih
        $findPendonor = Pendonor::where('kode_pendonor', $kode_pendonor)->first();
        $gol_darah = GolonganDarah::where('id',$findPendonor->id_golongan_darah)->first();
        $stokDarah = StokDarah::where('gol_darah', $gol_darah->id)->first();

        if ($stokDarah) {
            // Jika data stok darah dengan golongan darah yang sama sudah ada, tambahkan jumlahnya
            $stokDarah->jumlah -= $jumlah;
            $stokDarah->save();
        } else {
            // Jika tidak ada data stok darah dengan golongan darah yang sama, buat entri baru
            $stokDarah = new StokDarah();
            $stokDarah->gol_darah = $gol_darah;
            $stokDarah->jumlah = $jumlah;
            $stokDarah->save();
        }

        //masukkan ke riwayat ambil
        RiwayatAmbil::create([
             'pendonor_id' => $findPendonor->id,
             'jumlah_ambil' => $jumlah,
             'penerima' => $penerima,
             'kontak_penerima' => $kontak_penerima,
             'tanggal_ambil' => now()
        ]);

        // Setelah operasi insert atau update selesai, Anda dapat melakukan redirect
        return redirect()->route('stokdarah');
    }
}
