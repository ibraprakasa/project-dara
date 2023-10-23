<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return view('partials.forum-postingan', compact('data'));
    }

    public function deletepostingan($id)
    {
        $postingan = Post::find($id);
        // $jadwalPendonor = JadwalPendonor::where('id_jadwal_donor_darah', $jadwalDonor->id);
        // $jadwposalPendonor->delete();
        $postingan->delete();

        return redirect()->route('forum-postingan')->with('success', 'Postingan berhasil dihapus.');
    }
}
