<?php

namespace App\Http\Controllers;

use App\Models\Pendonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPendonorController extends Controller
{
    public function index(Request $request)
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $data = Pendonor::where('nama', 'LIKE', '%' . $search . '%')->get();
        } else {
            $data = Pendonor::all();
        }

        return view('partials.datapendonor', compact('data'));
    }

    public function insertpendonor(Request $request)
    {
        $request['kode_pendonor'] = 'dara' . rand(10000, 99999);
        $request->validate([
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        // Enkripsi password sebelum menyimpannya
        $request['password'] = Hash::make($request->password);

        Pendonor::create($request->all());
        return redirect()->route('datapendonor');
    }

    public function updatependonor(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $pendonor = Pendonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        $pendonor->update($request->all());

        return redirect()->route('datapendonor');
    }

    public function deletependonor($id)
    {
        $pendonor = Pendonor::find($id);

        $pendonor->delete();

        return redirect()->route('datapendonor');
    }
}
