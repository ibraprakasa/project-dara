<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
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
        $data = StokDarah::join('golongandarah', 'stokdarah.gol_darah', '=', 'golongandarah.id')
        ->select('golongandarah.nama', 'stokdarah.jumlah', 'stokdarah.updated_at')
        ->orderBy('golongandarah.nama')
        ->get();
        $kode_pendonor = Pendonor::orderBy('kode_pendonor')->get();
        $lokasi = JadwalDonor::orderBy('lokasi')->get();
        
        return view('partials.stokdarah', compact('data','kode_pendonor','lokasi'));
    }

    public function insertstok(Request $request)
    {
        $kode_pendonor = $request->input('kode_pendonor');
        $jumlah = $request->input('jumlah');
        $lokasi = $request->input('lokasi');

        // Cari data stok darah berdasarkan kode pendonor yang dipilih
        $findPendonor = Pendonor::where('kode_pendonor', $kode_pendonor)->first();
        $findLokasi = JadwalDonor::where('lokasi',$lokasi)->first();
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
            'lokasi_donor' => $findLokasi->lokasi,
            'tanggal_donor' => now()
        ]);

        $findPendonor->total_donor_darah += $jumlah;
        $findPendonor->update();
        // Setelah operasi insert atau update selesai, Anda dapat melakukan redirect
        return redirect()->route('stokdarah')->with('success', 'Stok Darah berhasil ditambahkan.');
    }

    public function updatestok(Request $request)
{
    $kode_pendonor = $request->input('kode_pendonor');
    $jumlah = $request->input('jumlah');
    $penerima = $request->input('penerima');
    $kontak_penerima = $request->input('kontak');

    // Cari data stok darah berdasarkan kode pendonor yang dipilih
    $findPendonor = Pendonor::where('kode_pendonor', $kode_pendonor)->first();
    $gol_darah = GolonganDarah::where('id', $findPendonor->id_golongan_darah)->first();
    $stokDarah = StokDarah::where('gol_darah', $gol_darah->id)->first();

    if ($stokDarah) {
        // Periksa apakah stok mencukupi untuk dikurangkan
        if ($stokDarah->jumlah >= $jumlah) {
            // Jika data stok darah dengan golongan darah yang sama sudah ada, kurangkan jumlahnya
            $stokDarah->jumlah -= $jumlah;
            $stokDarah->save();

            //masukkan ke riwayat ambil
            RiwayatAmbil::create([
                'pendonor_id' => $findPendonor->id,
                'jumlah_ambil' => $jumlah,
                'penerima' => $penerima,
                'kontak_penerima' => $kontak_penerima,
                'tanggal_ambil' => now()
            ]);

            // Setelah operasi insert atau update selesai, Anda dapat melakukan redirect
            return redirect()->route('stokdarah')->with('success', 'Stok Darah berhasil diperbarui.');
        } else {
            // Jika stok tidak mencukupi, kembalikan dengan pesan kesalahan
            return redirect()->back()->with('error', 'Stok Darah tidak cukup.');
        }
    } else {
        // Jika tidak ada data stok darah dengan golongan darah yang sama, kembalikan dengan pesan kesalahan
        return redirect()->back()->with('error', 'Stok Darah tidak ada.');
    }
}
}
