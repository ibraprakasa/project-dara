@php
use Carbon\Carbon;
@endphp

@extends('template')
@extends('sidebar')
@section('judul_halaman', 'Tanggapan')
@section('content')

<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('landing-page') }}">Pergi ke Halaman Website DARA Apps</a></li>
        </ol>
    </nav>
</div>

<div class="row text-center">
    <div class="col" style="margin-top:9px; margin-bottom:-70px; margin-left:45px">
        <div class="row" style="width:125%;font-weight: bold">
            <a href="#" id="tomboltestimoni" style="text-decoration:none;margin-right: 20px" class="col">
                Testimoni
            </a>
            <a href="#" id="tombolpesan" style="text-decoration:none" class="col">
                Pesan
            </a>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="content">
    <div class="tes1" id="filtertestimoni" style="margin-top:-110px;margin-left:-26px;margin-bottom:10px;">
        <div class="filterfeedback btn-group">
            <form action="/feedback" method="GET" style="display: flex;">
                <input class="btn searchbar-style" type="search" name="search" placeholder="Cari Testimoni...">
                <button type="submit" class="btn btn-primary searchicon-style">
                    <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                </button>
            </form>

            <div class="search-filter-group">
                <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filtertestimoni">
                    <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
                    <span style="font-size: 12px; color: white;">Filter</span>
                </button>
            </div>

            <div class="search-filter-group">
                @if(session('errorTestimoni'))
                <div class="alert-container">
                    <div class="alert-icon">&#9888;</div>
                    <div>
                        {{ session('errorTestimoni') }}
                    </div>
                </div>
                @elseif(session('successTestimoni'))
                <div class="alert-container1 success">
                    <div class="alert-icon">&#10004;</div> <!-- Ikon ceklis untuk sukses -->
                    <div>
                        {{ session('successTestimoni') }}
                    </div>
                </div>
                @elseif(isset($successMessage))
                <div class="alert-container12 success">
                    @if($search)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @elseif($tanggalawal && $tanggalakhir && $ratingdara && $filterStatus|| $tanggalawal && $tanggalakhir && $ratingdara || $tanggalawal && $tanggalakhir && $filterStatus || $ratingdara && $filterStatus || $ratingdara || $filterStatus)
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
                <th scope="col">Deskripsi</th>
                <th scope="col">Rating</th>
                <th scope="col">Tanggal Rating</th>
                <th scope="col">Status</th>
                <th colspan="3" scope="col">Action</th>
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
                    @for ($i = 0; $i < 4; $i++) <i class="bi bi-star-fill" style="color:#F29F05"></i>
                        @endfor
                </td>
                @elseif($row->star == 3)
                <td>
                    @for ($i = 0; $i < 3; $i++) <i class="bi bi-star-fill" style="color:#F29F05"></i>
                        @endfor
                </td>
                @elseif($row->star == 2)
                <td>
                    @for ($i = 0; $i < 2; $i++) <i class="bi bi-star-fill" style="color:#F29F05"></i>
                        @endfor
                </td>
                @elseif($row->star == 1)
                <td>
                    @for ($i = 0; $i < 1; $i++) <i class="bi bi-star-fill" style="color:#F29F05"></i>
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
                @if($row->status)
                <td>Ditampilkan</td>
                @elseif($row->status === 0)
                <td>-</td>
                @endif
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletetestimoni{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#infotestimoni{{ $row->id }}">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#kirimtestimoni{{ $row->id }}">
                        <i class="bi bi-arrow-right-circle-fill" style="color: #3B4B65;"></i>
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
    <!-- <div class="tomboltampilkan" id="tomboltampilkan">
            <button class="btn btn-success gaya-tampilkan">
                Kirim
            </button>
        </div> -->

    <div class="filtering" id="filterpesan">
        <div class="tes2" style="margin-top:-110px;margin-left:-26px;margin-bottom:10px;">
            <div class="filterfeedback btn-group">
                <form action="/feedback" method="GET" style="display: flex;">
                    <input class="btn searchbar-style" type="search" name="searchpesan" placeholder="Cari Pesan...">
                    <button type="submit" class="btn btn-primary searchicon-style">
                        <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                    </button>
                </form>

                <div class="search-filter-group"">
                    <button type=" submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterpesan">
                    <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
                    <span style="font-size: 12px; color: white;">Filter</span>
                    </button>
                </div>

                <div class="search-filter-group"">
                    @if(session('errorPesan'))
                    <div class=" alert-container">
                    <div class="alert-icon">&#9888;</div> <!-- Ikon segitiga peringatan -->
                    <div>
                        {{ session('errorPesan') }}
                    </div>
                </div>
                @elseif(session('successPesan'))
                <div class="alert-container1 success">
                    <div class="alert-icon">&#10004;</div> <!-- Ikon ceklis untuk sukses -->
                    <div>
                        {{ session('successPesan') }}
                    </div>
                </div>
                @elseif(isset($successMessagePesan))
                <div class="alert-container12 success">
                    @if($searchPesan)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @elseif($tanggalawalpesan || $tanggalakhirpesan || $statusPesan)
                    <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                    @endif
                    <div>
                        {{ $successMessagePesan }}
                    </div>
                </div>
                @endif
            </div>
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
            <th scope="col">Status</th>
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
            <td class="truncate-text">{{ $row->message }}</td>
            <td>{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
            </td>
            @if($row->status == 1)
            <td>-</td>
            @elseif($row->status == 2)
            <td>Dibalas</td>
            @endif
            <td>
                <button class="custom-button" data-toggle="modal" data-target="#deletepesan{{ $row->id }}">
                    <i class="bi bi-trash3" style="color:#E70000;"></i>
                </button>
            </td>
            <td>
                <button class="custom-button" data-toggle="modal" data-target="#infopesan{{ $row->id }}">
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

<!-- MODAL FILTER TESTIMONI-->
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
                    <div class="form-group">
                        <label style="color:black;font-weight:bold" for="filter_status">Filter Status</label>
                        <select class="kolom form-control" name="filter_status">
                            <option value="">-</option>
                            <option value="ditampilkan">Ditampilkan</option>
                            <option value="tidak-ditampilkan">Tidak Ditampilkan</option>
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
<!--  END MODAL  -->

<!-- MODAL DELETE TESTIMONI -->
@foreach($data as $key => $row)
<div class="modal fade" id="deletetestimoni{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus testimoni di baris {{ $key+$data->firstItem() }}?
            </div>
            <form action="{{ route('deletetestimoni', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger modalbuttondanger-style"v>>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL KIRIM TESTIMONI -->
@foreach($data as $key => $row)
<div class="modal fade" id="kirimtestimoni{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Kirim Testimoni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tampilkan testimoni baris ke-{{ $key+$data->firstItem() }} ke Website DARA?
            </div>
            <form action="{{ route('kirimtestimoni', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL DETAIL TESTIMONI -->
@foreach($data as $key => $row)
<div class="modal fade" id="infotestimoni{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Detail Testimoni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="rating-title" for="rating">Rating</label>
                <div class="form-group" style="text-align: center;">
                    @if($row->star == 5)
                    <td>
                        @for ($i = 0; $i < 5; $i++) <i class="bi bi-star-fill font-star"></i>
                            @endfor
                    </td>
                    @elseif($row->star == 4)
                    <td>
                        @for ($i = 0; $i < 4; $i++) <i class="bi bi-star-fill font-star" style="color:#F29F05"></i>
                            @endfor
                    </td>
                    @elseif($row->star == 3)
                    <td>
                        @for ($i = 0; $i < 3; $i++) <i class="bi bi-star-fill font-star" style="color:#F29F05"></i>
                            @endfor
                    </td>
                    @elseif($row->star == 2)
                    <td>
                        @for ($i = 0; $i < 2; $i++) <i class="bi bi-star-fill font-star" style="color:#F29F05"></i>
                            @endfor
                    </td>
                    @elseif($row->star == 1)
                    <td>
                        @for ($i = 0; $i < 1; $i++) <i class="bi bi-star-fill font-star" style="color:#F29F05"></i>
                            @endfor
                    </td>
                    @else
                    <td>
                        No stars
                    </td>
                    @endif
                </div>
                @if($row->text != null)
                <label style="color:black;font-weight:bold;">Deskripsi</label>
                <div class="form-group" style="color:black;background-color: white;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->text }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->nama }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal</label>
                            <input class="kolom form-control" placeholder="{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y (H:i') }} WIB)" readonly>
                        </div>
                    </div>
                </div>
                @elseif($row->text == null)
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->nama }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal</label>
                            <input class="kolom form-control" placeholder="{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y (H:i') }} WIB)" readonly>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL FILTER PESAN-->
<div class="modal fade filterpesan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <input type="date" class="kolom form-control" name="tanggal_dari_pesan" id="tanggal_dari">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black;font-weight:bold" for="tanggal_sampai">Sampai</label>
                                <input type="date" class="kolom form-control" name="tanggal_sampai_pesan" id="tanggal_sampai">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="status">Status</label>
                                <select class="kolom form-control" name="statuspesan" id="status">
                                    <option value="">-</option>
                                    <option value="1">Belum Dibalas</option>
                                    <option value="2">Sudah Dibalas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  END MODAL  -->

<!-- MODAL DELETE PESAN -->
@foreach($data1 as $key => $row)
<div class="modal fade" id="deletepesan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus pesan di baris {{ $key+$data->firstItem() }}?
            </div>
            <form action="{{ route('deletepesan', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger modalbuttondanger-style">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL DETAIL PESAN -->
@foreach($data1 as $key => $row)
<div class="modal fade" id="infopesan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Detail Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="judulpesan">PESAN</label>
                            <div class="form-group">
                                <textarea class="form-control pesan2" rows="6" readonly>{{ $row->message }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->name }}" readonly>
                        </div>
                    </div>
                    <div class="col md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal</label>
                            <input class="kolom form-control" placeholder="{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Email</label>
                            <input class="kolom form-control" placeholder="{{ $row->email }}" readonly>
                        </div>
                    </div>
                    <div class="col md-6">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kontak</label>
                            <input class="kolom form-control" placeholder="{{ $row->phone }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
                @if($row->reply == null)
                <button type="submit" data-dismiss="modal" data-target="#replypesan{{ $row->id }}" data-toggle="modal" class="btn btn-primary modalbuttonlaporanpalsu">Balas</button>
                @elseif($row->reply != null)
                <button type="submit" data-dismiss="modal" data-target="#sudahreplypesan{{ $row->id }}" data-toggle="modal" class="btn btn-primary modalbuttonlaporanpalsu">Lihat Balasan</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL BALAS PESAN -->
@foreach($data1 as $key => $row)
<div class="modal fade" id="replypesan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Balas Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kirimbalasanpesan') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col md-6">
                            <div class="form-group">
                                <label class="judulpesan"><u>Pesan dari Guest</u></label>
                                <div class="form-group" style="color:black;background-color: white;">
                                    <textarea class="form-control pesan" rows="6" readonly>{{ $row->message }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label class="judulbalasan"><u>Balasan dari DARA</u></label>
                                <div class="form-group" style="color:black;background-color: white;">
                                    <textarea class="form-control balasan" rows="6" name="message" placeholder="Masukkan balasan Anda disini..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label style="color:#E70000 !important;font-weight:bold">Nama</label>
                                <input class="kolom form-control" name="name" value="{{ $row->name }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label style="color:#E70000 !important;font-weight:bold">Email</label>
                                <input class="kolom form-control" name="email" value="{{ $row->email }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL SUDAH BALAS PESAN -->
@foreach($data1 as $key => $row)
<div class="modal fade" id="sudahreplypesan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Balas Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col md-6">
                        <div class="form-group">
                            <label class="judulpesan"><u>Pesan dari Guest</u></label>
                            <div class="form-group" style="color:black;background-color: white;">
                                <textarea class="kolom form-control pesan" rows="6" readonly>{{ $row->message }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col md-6">
                        <div class="form-group">
                            <label class="judulbalasan"><u>Balasan dari DARA</u></label>
                            <div class="form-group" style="color:black;background-color: white;">
                                <textarea class="form-control sudahadabalasan" rows="6" name="message" readonly>{{ $row->reply }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label style="color:#E70000 !important;font-weight:bold">Nama</label>
                            <input class="kolom form-control" name="name" value="{{ $row->name }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label style="color:#E70000 !important;font-weight:bold">Email</label>
                            <input class="kolom form-control" name="email" value="{{ $row->email }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<script>
    function tampilkanTabel(idTabel) {
        const tabeltestimoni = document.getElementById("tabeltestimoni");
        const tabelpesan = document.getElementById("tabelpesan");
        const filtertestimoni = document.getElementById("filtertestimoni");
        const filterpesan = document.getElementById("filterpesan");
        const pagination1 = document.querySelector(".pagination1");
        const pagination2 = document.querySelector(".pagination2");
        const tomboltampilkan = document.querySelector(".tomboltampilkan")

        if (idTabel === "tabeltestimoni") {
            tabeltestimoni.style.display = "table";
            tabelpesan.style.display = "none";
            filtertestimoni.style.display = "block"; // 
            filterpesan.style.display = "none"; // 
            // tomboltampilkan.style.display = "flex";
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
            // tomboltampilkan.style.display = "none";
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