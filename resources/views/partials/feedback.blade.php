@php
use Carbon\Carbon;
@endphp

@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Feedback
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="row text-center">
    <div class="col" style="margin-top:100px; margin-bottom:-70px; margin-left:40px">
        <div class="row" style="width:125%;font-weight: bold">
            <a href="#" id="tomboltestimoni" style="text-decoration: none; margin-right: 10px" class="col">
                Testimoni
            </a>
            <a href="#" id="tombolpesan" style="text-decoration: none" class="col">
                Pesan
            </a>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="content">
    <div class="tes1" id="filtertestimoni" style="margin-top:-110px;margin-left:-26px;margin-bottom:10px;">
        <div class="filter btn-group">
            <form action="/feedback" method="GET" style="display: flex;">
                <input class="btn" type="search" name="search" placeholder="Cari Testimoni..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
                <button type="submit" class="btn btn-primary" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
                    <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                </button>
            </form>

            <div style="display: flex; margin-left:15px;">
                <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filtertestimoni">
                    <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
                    <span style="font-size: 12px; color: white;">Filter</span>
                </button>
            </div>

            <div style="display: flex; margin-left:15px;">
                @if(isset($successMessage))
                <div class="alert-container12 success">
                    @if($search)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @else
                    <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                    @endif
                    <div>
                        {{ $successMessage }}
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>

    <table class="table table-bordered" id="tabeltestimoni" style="display:none">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Tanggapan</th>
                <th scope="col">Rating</th>
                <th scope="col">Tanggal Rating</th>
                <th colspan="2" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($data) == 0)
            <tr>
                <td colspan="8" style="font-weight: bold;text-align:center;">Testimoni belum ada</td>
            </tr>
            @else
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+$data->firstItem() }}</th>
                <td>{{ $row->pendonor->kode_pendonor }}</td>
                <td>{{ $row->pendonor->nama }}</td>
                <td class="truncate-text">{{ $row->text }}</td>
                @if($row->star == 5)
                <td>
                    @for ($i = 0; $i < 5; $i++) <i class="bi bi-star-fill" style="color:#F29F05"></i>
                        @endfor
                </td>
                @elseif($row->star == 4)
                <td>
                    @for ($i = 0; $i < 4; $i++) <i class="bi bi-star-fill" style="color:#F29F05">></i>
                        @endfor
                </td>
                @elseif($row->star == 3)
                <td>
                    @for ($i = 0; $i < 3; $i++) <i class="bi bi-star-fill" style="color:#F29F05">></i>
                        @endfor
                </td>
                @elseif($row->star == 2)
                <td>
                    @for ($i = 0; $i < 2; $i++) <i class="bi bi-star-fill" style="color:#F29F05">></i>
                        @endfor
                </td>
                @elseif($row->star == 1)
                <td>
                    @for ($i = 0; $i < 1; $i++) <i class="bi bi-star-fill" style="color:#F29F05">></i>
                        @endfor
                </td>
                @else
                <td>
                    No stars
                </td>
                @endif
                <td>
                    {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletetestimoni{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#infotestimoni">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination1">
        {{ $data->links() }}
    </div>

    <div class="tes2" id="filterpesan" style="margin-top:-110px;margin-left:-26px;margin-bottom:10px;">
        <div class="filter btn-group">
            <form action="/feedback" method="GET" style="display: flex;">
                <input class="btn" type="search" name="search" placeholder="Cari Pesan..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
                <button type="submit" class="btn btn-primary" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
                    <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                </button>
            </form>

            <div style="display: flex; margin-left:15px;">
                <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterpesan">
                    <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
                    <span style="font-size: 12px; color: white;">Filter</span>
                </button>
            </div>

            <div style="display: flex; margin-left:15px;">
                @if(isset($successMessage))
                <div class="alert-container12 success">
                    @if($search)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @else
                    <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                    @endif
                    <div>
                        {{ $successMessage }}
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>

    <table class="table table-bordered" id="tabelpesan">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Kontak</th>
                <th scope="col">Pesan</th>
                <th scope="col">Tanggal Pesan</th>
                <th colspan="2" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($data1) == 0)
            <tr>
                <td colspan="8" style="  font-weight: bold;text-align:center;">Pesan belum ada</td>
            </tr>
            @else
            @foreach($data1 as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->message }}</td>
                <td>{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletepesan{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#infopesan">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination2">
        {{ $data1->links() }}
    </div>


</div>

<!-- MODAL FILTER -->
<div class="modal fade filtertestimoni" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Filter Berdasarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/feedback" method="GET">
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
                        <label style="color:black;font-weight:bold" for="rating">Rating</label>
                        <select class="kolom form-control" name="star">
                            <option value="">-</option>
                            <option value="1">&#9733;</option>
                            <option value="2">&#9733;&#9733;</option>
                            <option value="3">&#9733;&#9733;&#9733;</i></option>
                            <option value="4">&#9733;&#9733;&#9733;&#9733;</i></option>
                            <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</i></option>

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
<!--  END MODAL  -->

<script>
    function tampilkanTabel(idTabel) {
        const tabeltestimoni = document.getElementById("tabeltestimoni");
        const tabelpesan = document.getElementById("tabelpesan");
        const filtertestimoni = document.getElementById("filtertestimoni");
        const filterpesan = document.getElementById("filterpesan");
        const pagination1 = document.querySelector(".pagination1");
        const pagination2 = document.querySelector(".pagination2");

        if (idTabel === "tabeltestimoni") {
            tabeltestimoni.style.display = "table";
            tabelpesan.style.display = "none";
            filtertestimoni.style.display = "block"; // 
            filterpesan.style.display = "none"; // 
            document.getElementById("tomboltestimoni").classList.remove("tabel-mati");
            document.getElementById("tomboltestimoni").classList.add("tabel-aktif");
            document.getElementById("tombolpesan").classList.remove("tabel-aktif");
            document.getElementById("tombolpesan").classList.add("tabel-mati");
            pagination1.style.display = "block"; // Menampilkan paginasi 1
            pagination2.style.display = "none"; // Menyembunyikan paginasi 2
        } else if (idTabel === "tabelpesan") {
            tabeltestimoni.style.display = "none";
            tabelpesan.style.display = "table";
            filtertestimoni.style.display = "none"; // 
            filterpesan.style.display = "block"; // 
            document.getElementById("tombolpesan").classList.remove("tabel-mati");
            document.getElementById("tomboltestimoni").classList.remove("tabel-aktif");
            document.getElementById("tombolpesan").classList.add("tabel-aktif");
            document.getElementById("tomboltestimoni").classList.add("tabel-mati");
            pagination1.style.display = "none"; // Menyembunyikan paginasi 1
            pagination2.style.display = "block"; // Menampilkan paginasi 2

        }
        // Simpan status ke localStorage
        localStorage.setItem('tabelStatus', idTabel);
    }
    document.getElementById("tomboltestimoni").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabeltestimoni");
    });

    document.getElementById("tombolpesan").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabelpesan");
    });

    window.onload = function() {
        // Ambil status dari localStorage jika ada
        const status = localStorage.getItem('tabelStatus');
        if (status === 'tabelpesan') {
            tampilkanTabel("tabelpesan");
        } else {
            tampilkanTabel("tabeltestimoni");
        }
    };
</script>



@endsection