<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
use App\Models\jadwalPendonor;
use App\Models\Pendonor;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class JadwalDonorController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $sort = request()->input('sort');

        $query = JadwalDonor::query();

        if ($search) {
            $query->where('lokasi', 'LIKE', '%' . $search . '%');
        }

        if ($sort) {
            if ($sort === 'tanggal_asc') {
                $query->orderBy('tanggal_donor')->orderBy('jam_mulai');
            } elseif ($sort === 'tanggal_desc') {
                $query->orderByDesc('tanggal_donor')->orderBy('jam_mulai');
            }
        }else {
            // Default sorting (you can change this to your preferred default sorting)
            $query->orderBy('updated_at');
        }

        $data = $query->paginate(10);

        return view('partials.jadwaldonor', compact('data'));
    }

    public function infopendaftar(Request $request)
{
    $id = $request->input('id');
    $search = $request->input('search');

    $jadwalPendonor = JadwalPendonor::where('id_jadwal_donor_darah', $id)->get();
    $pendaftar = [];

    if ($search) {
        $jadwalPendonor = JadwalPendonor::where('id_jadwal_donor_darah', $id)
            ->whereHas('pendonor', function ($query) use ($search) {
                $query->where('nama', 'LIKE', '%' . $search . '%');
            })->get();
    }

    foreach ($jadwalPendonor as $pendonor) {
        $dataPendonor = Pendonor::find($pendonor->id_pendonor);
        $Pendonor = [
            'id' => $dataPendonor->id,
            'kode_pendonor' => $dataPendonor->kode_pendonor,
            'nama' => $dataPendonor->nama,
            'goldar' => GolonganDarah::where('id', $dataPendonor->id_golongan_darah)->first()->nama,
            'kontak' => $dataPendonor->kontak_pendonor,
            // tambahkan kolom lain yang Anda perlukan di sini
        ];

        // Menambahkan data pendonor ke dalam array pendaftar
        $pendaftar[] = $Pendonor;
    }
    return view('partials.infopendaftar', compact('pendaftar'));
}

    public function deletejadwalpendonor($id,Request $request){
        $pendaftar = jadwalPendonor::where('id_pendonor',$id)->where('id_jadwal_donor_darah',$request->input('id_jadwal'))->first();
        $jumlahPendaftar = JadwalDonor::where('id',$request->input('id_jadwal'))->first();
        $jumlahPendaftar->jumlah_pendonor = $jumlahPendaftar->jumlah_pendonor -  1;
        $pendaftar->delete();
        $jumlahPendaftar->update();
        return redirect()->route('infopendaftar', ['id' => $request->input('id_jadwal')])->with('success', 'Pendaftar berhasil dihapus.');
    }
    public function insertjadwaldonor(Request $request)
    {
        JadwalDonor::create($request->all());
        return redirect()->route('jadwaldonor')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function updatejadwaldonor(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $jadwalDonor = JadwalDonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        $jadwalDonor->update($request->all());

        return redirect()->route('jadwaldonor')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function deletejadwaldonor($id)
    {
        $jadwalDonor = JadwalDonor::find($id);
        $jadwalPendonor = JadwalPendonor::where('id_jadwal_donor_darah', $jadwalDonor->id);
        $jadwalPendonor->delete();
        $jadwalDonor->delete();

        return redirect()->route('jadwaldonor')->with('success', 'Jadwal berhasil dihapus.');
    }
}
