@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Forum
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('forum-postingan') }}">Postingan</a></li>
            <li class="breadcrumb-item">Komentar</li>
            <li class="breadcrumb-item">Balasan</a></li>
        </ol>
    </nav>
</div>

<div class="filte btn-group">
    <form action="/forum-postingan" method="GET" style="display: flex;">
        <input class="btn searchbar-style" type="search" name="search" placeholder="Cari Postingan...">
        <button type="submit" class="btn btn-dark searchicon-style">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>

<div class="filte btn-group">
    <button type="button" class="btn btn-primary filter-icon" data-toggle="modal" data-target="#filterpostingan">
        <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
        <span style="font-size: 12px; color: white;">Filter</span>
    </button>
</div>

<div class="filte btn-group wow">
    @if(session('success'))
    <div class="alert-container1 success">
        <div class="alert-icon">&#10004;</div> <!-- Ikon ceklis untuk sukses -->
        <div>
            {{ session('success') }}
        </div>
    </div>
    @elseif(isset($successMessage))
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


<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Teks</th>
                <th scope="col">Gambar</th>
                <th scope="col">Jumlah Komentar</th>
                <th scope="col">Tanggal Posting</th>
                <th colspan="2" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($postingan) == 0)
            <tr>
                <td colspan="9" style="font-weight: bold;text-align:center;">Postingan tidak ada</td>
            </tr>
            @else
            @foreach($postingan as $key => $row)
            <tr>
                <th scope="row">{{ $key+$postingan->firstItem() }}</th>
                <td>{{ $row->pendonor->kode_pendonor }}</td>
                <td>{{ $row->pendonor->nama }}</td>
                <td class="truncate-text">{{ $row->text }}</td>
                <td>
                    @if($row->gambar == null)
                        <img src="assets/img/daraicon.png"" alt="" style="width:100px; height:100px;">
                    @else
                        <a data-fancybox="gallery" href="{{ asset('assets/post/'.$row->gambar) }}" data-caption="{{ $row->text }}">
                        <img src="{{ asset('assets/post/'.$row->gambar) }}" alt="" style="width:100px; height:100px;">
                    </a>
                    @endif
                </td>
                <td>
                    {{ $row->comments->count() }}
                    <form action="{{ route('forum-komentar', ['id_post' => $row->id]) }}" method="GET" style="display: inline-block;">
                        <input type="hidden" name="id" value="{{ $row->id }}">
                        <button class="custom-button" type="submit">
                            <svg style="fill:#1B77A0" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z" />
                            </svg>
                        </button>
                    </form>
                </td>
                <td>{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletepostingan{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#infopostingan{{ $row->id }}">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $postingan ->links() }}
</div>

<!-- MODAL DELETE POSTINGAN -->
@foreach($postingan as $key => $row)
<div class="modal fade" id="deletepostingan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus postingan di baris {{ $key+$postingan->firstItem() }}?
            </div>
            <form action="{{ route('deletepostingan', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" style="background-color: black; border-radius:10px" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #E70000; border-radius:10px">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->


<!-- MODAL INFO POSTINGAN -->
@foreach($postingan as $key => $row)
<div class="modal fade" id="infopostingan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Detail Postingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($row->gambar != null)
                <div class="form-group" style="text-align: center;">
                    <a data-fancybox="gallery" href="{{ asset('assets/post/'.$row->gambar) }}" data-caption="{{ $row->text }}">
                        <img src="{{ asset('assets/post/'.$row->gambar) }}" alt="Gambar" width="500" height="250">
                    </a>
                </div>
                <label style="color:black;font-weight:bold">Status</label>
                <div class="form-group" style="color:black;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->text }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal</label>
                            <input class="kolom form-control" placeholder="{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y H:i') }}" readonly>
                        </div>
                    </div>
                </div>
                @elseif($row->gambar == null)
                <label style="color:black;font-weight:bold">Status</label>
                <div class="form-group" style="color:black;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->text }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->pendonor->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal</label>
                            <input class="kolom form-control" placeholder="{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y H:i') }}" readonly>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" style="background-color: black; border-radius:10px" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END MODAL -->

    <!-- MODAL FILTER POSTINGAN -->
    <div class="modal fade" id="filterpostingan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('forum-postingan') }}" method="GET">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius: 10px">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  END MODAL  -->


    @endsection