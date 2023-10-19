@php
use Carbon\Carbon;
@endphp

@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Riwayat Donor
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="row text-center">
    <div class="col" style="margin-top:100px; margin-bottom:-70px; margin-left:40px">
        <div class="row" style="width:145%;font-weight: bold">
            <a href="#" id="tombol1" style="text-decoration: none; margin-right: 10px" class="col">
                Riwayat Donor Darah
            </a>
            <a href="#" id="tombol2" style="text-decoration: none" class="col">
                Riwayat Ambil Darah
            </a>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="waw btn-group" style="margin-top:75px; margin-bottom:-90px">
    <form action="/riwayatdonor" method="GET" style="display: flex;">
        <input class="btn" type="search" name="search" placeholder="Cari Riwayat..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-primary" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>

    <div style="display: flex; margin-left:15px;">
        <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterriwayat">
            <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
            <span style="font-size: 12px; color: white;">Filter</span>
        </button>
    </div>
</div>

<div class="content">
    <table class="table table-bordered" id="tabel1" style="display:none">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Donor</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Gol. Darah</th>
                <th scope="col">Lokasi</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($riwayat_donor) == 0)
            <tr>
                <td colspan="6" style="text-align:center;">Riwayat donor belum ada</td>
            </tr>
            @else
            @foreach($riwayat_donor as $key => $rd)
            <tr>
                <th scope="row">{{ $key+$riwayat_donor->firstItem() }}</th>
                <td>{{ $rd->pendonor->nama }}</td>
                <td>{{ $rd->jumlah_donor }}</td>
                <td>{{ Carbon::parse($rd->tanggal_donor)->translatedFormat('l, j F Y') }}</td>
                <td>{{ $rd->pendonor->golongandarah->nama }}</td>
                <td>{{ $rd->lokasi_donor }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination1">
        {{ $riwayat_donor->links() }}
    </div>

    <table class="table table-bordered" id="tabel2">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Ambil</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Gol. Darah</th>
                <th scope="col">Penerima</th>
                <th scope="col">Kontak Penerima</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($riwayat_ambil) == 0)
            <tr>
                <td colspan="7" style="text-align:center;">Riwayat ambil belum ada</td>
            </tr>
            @else
            @foreach($riwayat_ambil as $key => $rd)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $rd->pendonor->nama }}</td>
                <td>{{ $rd->jumlah_ambil }}</td>
                <td>{{ Carbon::parse($rd->tanggal_ambil)->translatedFormat('l, j F Y') }}</td>
                <td>{{ $rd->pendonor->golongandarah->nama }}</td>
                <td>{{ $rd->penerima }}</td>
                <td>{{ $rd->kontak_penerima }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination2">
        {{ $riwayat_donor->links() }}
    </div>


</div>

<!-- MODAL FILTER RIWAYAT -->
@foreach($riwayat_donor as $row)
<div class="modal fade filterriwayat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Filter Berdasarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/riwayatdonor" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black;font-weight:bold" for="tanggal_dari">Dari</label>
                                <input type="date" class="kolom form-control" name="tanggal_dari" id="tanggal_dari">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black;font-weight:bold" for="tanggal_sampai">Sampai</label>
                                <input type="date" class="kolom form-control" name="tanggal_sampai" id="tanggal_sampai">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="color:black;font-weight:bold" for="goldar">Golongan Darah</label>
                        <select class="kolom form-control" name="id_golongan_darah">
                            <option value="">-</option>
                            @foreach($goldarDaftar as $darah)
                            <option class="kolom form-control" value="{{ $darah->id }}" @if(request('id_golongan_darah')==$darah->id) selected @endif>{{ $darah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="color:black;font-weight:bold" for="lokasi">Lokasi</label>
                        <select class="kolom form-control" name="lokasi" id="lokasi">
                            <option class="kolom form-control" value="">-</option>
                            @foreach($lokasiDaftar as $lp)
                            <option class="kolom form-control" value="{{ $lp->lokasi }}">{{ $lp->lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius: 10px">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!--  END MODAL  -->

<script>
    function tampilkanTabel(idTabel) {
        const tabel1 = document.getElementById("tabel1");
        const tabel2 = document.getElementById("tabel2");
        const pagination1 = document.querySelector(".pagination1");
        const pagination2 = document.querySelector(".pagination2");

        if (idTabel === "tabel1") {
            tabel1.style.display = "table";
            tabel2.style.display = "none";
            document.getElementById("tombol1").classList.remove("tabel-mati");
            document.getElementById("tombol1").classList.add("tabel-aktif");
            document.getElementById("tombol2").classList.remove("tabel-aktif");
            document.getElementById("tombol2").classList.add("tabel-mati");
            pagination1.style.display = "block"; // Menampilkan paginasi 1
            pagination2.style.display = "none"; // Menyembunyikan paginasi 2
        } else if (idTabel === "tabel2") {
            tabel1.style.display = "none";
            tabel2.style.display = "table";
            document.getElementById("tombol2").classList.remove("tabel-mati");
            document.getElementById("tombol1").classList.remove("tabel-aktif");
            document.getElementById("tombol2").classList.add("tabel-aktif");
            document.getElementById("tombol1").classList.add("tabel-mati");
            pagination1.style.display = "none"; // Menyembunyikan paginasi 1
            pagination2.style.display = "block"; // Menampilkan paginasi 2

        }
        // Simpan status ke localStorage
        localStorage.setItem('tabelStatus', idTabel);
    }
    document.getElementById("tombol1").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabel1");
    });

    document.getElementById("tombol2").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabel2");
    });

    window.onload = function() {
        // Ambil status dari localStorage jika ada
        const status = localStorage.getItem('tabelStatus');
        if (status === 'tabel2') {
            tampilkanTabel("tabel2");
        } else {
            tampilkanTabel("tabel1");
        }
    };
</script>



@endsection