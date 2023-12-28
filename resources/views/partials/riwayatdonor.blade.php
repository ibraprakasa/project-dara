@php
use Carbon\Carbon;
@endphp

@extends('template')
@section('judul_halaman', 'Riwayat')
@section('breadcrumb', 'Riwayat')


@section('content')


<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md" style="margin-top: 85px; margin-bottom: -62px; margin-left: 30px">
            <div class="row tombol-style">
                <a href="#" id="tombol1" style="text-decoration: none; margin-right: 20px" class="col">
                    Riwayat Donor Darah
                </a>
                <a href="#" id="tombol2" style="text-decoration: none" class="col">
                    Riwayat Ambil Darah
                </a>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<div class="waw btn-group" style="margin-top:75px; margin-bottom:-83px">
    <form action="/riwayatdonor" method="GET" style="display: flex;">
        <input class="btn btn-primary searchbar-style" type="search" name="search" placeholder="Cari Riwayat...">
        <button type="submit" class="btn btn-primary searchicon-style">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>

    <div class="search-filter-group">
        <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterriwayat">
            <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
            <span style="font-size: 12px; color: white;">Filter</span>
        </button>
    </div>

    <div class="search-filter-group">
        @if(isset($successMessage))
        <div class="alert-filter">
            @if($search)
            <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
            @else
            <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
            @endif
            <div style="white-space: nowrap;">
                {{ $successMessage }}
            </div>
        </div>
        @endif
    </div>

</div>

<div class="content">
    <table class="table table-bordered" id="tabel1" style="display:none">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr style="white-space: nowrap;">
                <th scope="col">#</th>
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Gol. Darah</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Jumlah Kantong</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($riwayat_donor) == 0)
            <tr>
                <td colspan="7" style="font-weight: bold;text-align:center;">Riwayat donor belum ada</td>
            </tr>
            @else
            @foreach($riwayat_donor as $key => $rd)
            <tr>
                <th scope="row">{{ $key+$riwayat_donor->firstItem() }}</th>
                <td>{{ $rd->pendonor->kode_pendonor }}</td>
                <td>{{ $rd->pendonor->nama }}</td>
                <td>{{ $rd->pendonor->golongandarah->nama }}</td>
                <td>{{ $rd->lokasi_donor }}</td>
                <td>{{ $rd->jumlah_donor }}</td>
                <td>{{ Carbon::parse($rd->tanggal_donor)->translatedFormat('l, j F Y') }}</td>
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
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Gol. Darah</th>
                <th scope="col">Penerima</th>
                <th scope="col">Kontak Penerima</th>
                <th scope="col">Jumlah Ambil</th>
                <th scope="col">Tanggal Ambil</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($riwayat_ambil) == 0)
            <tr>
                <td colspan="7" style="  font-weight: bold;text-align:center;">Riwayat ambil belum ada</td>
            </tr>
            @else
            @foreach($riwayat_ambil as $key => $rd)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $rd->pendonor->kode_pendonor }}</td>
                <td>{{ $rd->pendonor->nama }}</td>
                <td>{{ $rd->pendonor->golongandarah->nama }}</td>
                <td>{{ $rd->penerima }}</td>
                <td>{{ $rd->kontak_penerima }}</td>
                <td>{{ $rd->jumlah_ambil }}</td>
                <td>{{ Carbon::parse($rd->tanggal_ambil)->translatedFormat('l, j F Y') }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination2">
        {{ $riwayat_ambil->links() }}
    </div>


</div>

<!-- MODAL FILTER RIWAYAT -->
<!-- @foreach($riwayat_donor as $row) -->
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
                        <label style="color:black;font-weight:bold" for="id_golongan_darah">Golongan Darah</label>
                        <select class="kolom form-control" id="id_golongan_darah" name="id_golongan_darah">
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
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- @endforeach -->
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


