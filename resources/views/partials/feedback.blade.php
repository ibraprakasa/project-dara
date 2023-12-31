@php
use Carbon\Carbon;
@endphp

@extends('template')
@section('judul_halaman', 'Tanggapan')
@section('breadcrumb', 'Tanggapan')
@section('content')

<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md" style="margin-top: 85px; margin-bottom: -62px; margin-left: 30px">
            <div class="row tombol-style">
                <a href="#" id="tomboltestimoni" style="text-decoration: none; margin-right: 20px" class="col">
                    Testimoni
                </a>
                <a href="#" id="tombolpesan" style="text-decoration: none" class="col">
                    Pesan
                </a>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<div class="content">
    <div class="tes1" id="filtertestimoni" style="margin-top:-110px;margin-left:-26px;margin-bottom:10px;">
        <div class="filter2menu btn-group">
            <form action="/feedback" method="GET" style="display: flex;">
                <input class="btn btn-primary searchbar-style" type="search" name="search" placeholder="Cari Testimoni..." value="{{ request('search') }}">
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
                <div class="alert alert-failed">
                    <div class="alert-icon">&#9888;</div>
                    <div class="nowrap">
                        {{ session('errorTestimoni') }}
                    </div>
                </div>
                @elseif(session('successTestimoni'))
                <div class="alert alert-success">
                    <div class="alert-icon">&#10004;</div> <!-- Ikon ceklis untuk sukses -->
                    <div class="nowrap">
                        {{ session('successTestimoni') }}
                    </div>
                </div>
                @elseif(isset($successMessage))
                <div class="alert-filter">
                    @if($search)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @elseif($tanggalawal && $tanggalakhir && $ratingdara && $filterStatus|| $tanggalawal && $tanggalakhir && $ratingdara || $tanggalawal && $tanggalakhir && $filterStatus || $ratingdara && $filterStatus || $ratingdara || $filterStatus)
                    <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                    @endif
                    <div class="nowrap">
                        {{ $successMessage }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <table class="table table-bordered" id="tabeltestimoni" style="display:none">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr style="white-space: nowrap;">
                <th scope="col">#</th>
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Rating ( {{ $rataRating }} )</th>
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
                @if($row->text === null || $row->text === '')
                <td class="truncate-text"><b>-</b></td>
                @else
                <td class="truncate-text">{{ $row->text }}</td>
                @endif
                @if($row->star == 5)
                <td class="nowrap">
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
                <td>
                    <b>Tampil</b>
                </td>
                @elseif($row->status === 0 )
                <td>
                    <b>-</b>
                </td>
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
                @if($row->status)
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#batalkirimtestimoni{{ $row->id }}" title="Tampil di Website">
                        <i class="fa fa-check-circle" style="color: #03A13B;"></i>
                    </button>
                </td>
                @elseif($row->status === 0 )
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#kirimtestimoni{{ $row->id }}" title="Tidak Tampil di Website">
                        <i class="fa fa-times-circle" style="color: #E70000;"></i>
                    </button>
                </td>
                @endif
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination1">
        {{ $data->links() }}
    </div>

    <div class="filtering" id="filterpesan">
        <div class="tes2" style="margin-top:-110px;margin-left:-26px;margin-bottom:10px;">
            <div class="filter2menu btn-group">
                <form action="/feedback" method="GET" style="display: flex;">
                    <input class="btn btn-primary searchbar-style" type="search" name="searchpesan" placeholder="Cari Pesan..." value="{{ request('search') }}">
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
                    <div class="alert alert-failed">
                    <div class="alert-icon">&#9888;</div>
                    <div class="nowrap">
                        {{ session('errorPesan') }}
                    </div>
                </div>
                @elseif(session('successPesan'))
                <div class="alert alert-success">
                    <div class="alert-icon">&#10004;</div>
                    <div class="nowrap">
                        {{ session('successPesan') }}
                    </div>
                </div>
                @elseif(isset($successMessagePesan))
                <div class="alert-filter">
                    @if($searchPesan)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @elseif($tanggalawalpesan || $tanggalakhirpesan || $statusPesan)
                    <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                    @endif
                    <div class="nowrap">
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
        <tr style="white-space: nowrap;">
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
            <td><b>-</b></td>
            @elseif($row->status == 2)
            <td><b>Dibalas</b></td>
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
                                <label style="color:black;font-weight:bold" for="tanggal_dari">Dari Tanggal</label>
                                <input type="date" class="kolom form-control" name="tanggal_dari" id="tanggal_dari">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black;font-weight:bold" for="tanggal_sampai">Sampai Tanggal</label>
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
                    <button type="submit" class="btn btn-danger modalbuttondanger-style" v>>Hapus</button>
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
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Kirim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Publikasikan testimoni baris ke-{{ $key+$data->firstItem() }} ke Website DARA?
            </div>
            <form action="{{ route('kirimtestimoni', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL BATAL KIRIM TESTIMONI -->
@foreach($data as $key => $row)
<div class="modal fade" id="batalkirimtestimoni{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Sembunyikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sembunyikan testimoni baris ke-{{ $key+$data->firstItem() }} dari Website DARA?
            </div>
            <form action="{{ route('batalkirimtestimoni', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Ya</button>
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
                                <label style="color:black;font-weight:bold" for="tanggal_dari">Dari Tanggal</label>
                                <input type="date" class="kolom form-control" name="tanggal_dari_pesan" id="tanggal_dari">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black;font-weight:bold" for="tanggal_sampai">Sampai Tanggal</label>
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
                    <button type="button" class="btn btn-dark modalbuttonclose-style mr-auto" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary modalbuttonlaporanpalsu" data-dismiss="modal" data-toggle="modal" data-target="#infopesan{{ $row->id }}">Kembali</button>
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
                <button type="button" class="btn btn-dark modalbuttonclose-style mr-auto" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary modalbuttonlaporanpalsu" data-dismiss="modal" data-toggle="modal" data-target="#infopesan{{ $row->id }}">Kembali</button>
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
            document.getElementById("tomboltestimoni").classList.remove("tabel-mati");
            document.getElementById("tomboltestimoni").classList.add("tabel-aktif");
            document.getElementById("tombolpesan").classList.remove("tabel-aktif");
            document.getElementById("tombolpesan").classList.add("tabel-mati");
            pagination1.style.display = "block";
            pagination2.style.display = "none"; 
        } else if (idTabel === "tabelpesan") {
            tabeltestimoni.style.display = "none";
            tabelpesan.style.display = "table";
            filtertestimoni.style.display = "none"; // 
            filterpesan.style.display = "block"; // 
            document.getElementById("tombolpesan").classList.remove("tabel-mati");
            document.getElementById("tomboltestimoni").classList.remove("tabel-aktif");
            document.getElementById("tombolpesan").classList.add("tabel-aktif");
            document.getElementById("tomboltestimoni").classList.add("tabel-mati");
            pagination1.style.display = "none"; 
            pagination2.style.display = "block"; 

        }
        localStorage.setItem('tabelStatus', idTabel);
    }
    document.getElementById("tomboltestimoni").addEventListener("click", function(e) {
        e.preventDefault(); 
        tampilkanTabel("tabeltestimoni");
    });

    document.getElementById("tombolpesan").addEventListener("click", function(e) {
        e.preventDefault(); 
        tampilkanTabel("tabelpesan");
    });

    window.onload = function() {
        const status = localStorage.getItem('tabelStatus');

        if (status === 'tabelpesan') {
            tampilkanTabel("tabelpesan");
        } else {
            tampilkanTabel("tabeltestimoni");
        }
    };
</script>

<script>
    $(document).ready(function() {
        $('.modalbuttonlaporanpalsu').on('click', function() {
            $('#infopesan{{ $row->id }}').modal('hide');

            $('#replypesan{{ $row->id }}').modal('show');
        });
    });
</script>
@endsection