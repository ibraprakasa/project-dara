@extends('template')
@section('judul_halaman', 'Forum')
@section('breadcrumb','Forum')
@section('content')

<!-- <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('forum-postingan') }}">Postingan</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Komentar</a></li>
            <li class="breadcrumb-item">Balasan</li>
        </ol>
    </nav>
</div> -->

<div class="filter btn-group">
    @foreach($komentar as $row)
    <form action="{{ route('forum-komentar', ['id_post' => $row->id_post]) }}" method="GET" style="display: flex;">
        <input type="hidden" name="id" value="{{ $row->id }}">
        @endforeach
        <input class="btn btn-primary searchbar-style" type="search" name="search" placeholder="Cari Komentar..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary searchicon-style">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>

    <div class="ml-4">
        <button type="button" class="btn btn-primary filter-icon" data-toggle="modal" data-target="#filterkomentar">
            <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
            <span style="font-size: 12px; color: white;">Filter</span>
        </button>
    </div>

    <div class="ml-4">
        @if(session('success'))
        <div class="alert alert-success">
            <div class="alert-icon">&#10004;</div> 
            <div class="nowrap">
                {{ session('success') }}
            </div>
        </div>
        @elseif(isset($successMessage))
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

<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered" style="text-align:center">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr style="white-space: nowrap;">
                <th scope="col">#</th>
                <th scope="col">kode_pendonor</th>
                <th scope="col">nama</th>
                <th scope="col">teks</th>
                <th scope="col">jumlah balasan</th>
                <th scope="col">Tanggal Komentar</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($komentar) == 0)
            <tr>
                <td style="font-weight:bold" colspan="7" style="text-align:center;">Komentar belum ada</td>
            </tr>
            @else
            @foreach($komentar as $nomor => $komen)
            <tr>
                <td>{{ $nomor+1 }}</td>
                <td>{{ $komen->pendonor->kode_pendonor }}</td>
                <td>{{ $komen->pendonor->nama }}</td>
                <td>{{ $komen->text }}</td>
                <td>{{ $komen->reply->count() }}
                    <form action="{{ route('forum-balasan', ['id_comment' => $komen->id]) }}" method="GET" style="display: inline-block;">
                        <input type="hidden" name="id" value="{{ $komen->id }}">
                        <button class="custom-button" type="submit">
                            <svg style="fill:#1B77A0" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z" />
                            </svg>
                        </button>
                    </form>
                </td>
                <td>{{ $komen->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $komen->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletekomentar{{ $komen->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $komentar ->links() }}
</div>

<!-- MODAL FILTER KOMENTAR -->
<div class="modal fade" id="filterkomentar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @foreach($komentar as $row)
            <form action="{{ route('forum-komentar', ['id_post' => $row->id_post]) }}" method="GET">
                @endforeach
                <input class="btn" type="text" name="id" value="{{ request('id') }}" hidden>
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
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  END MODAL  -->

<!-- MODAL DELETE KOMENTAR -->
@foreach($komentar as $key => $row)
<div class="modal fade" id="deletekomentar{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus komentar di baris {{ $key + $komentar->firstItem() }}?
            </div>
            <form action="{{ route('deletekomentar', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id_post" value="{{ request('id_post') }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger modalbuttondanger-style">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- END MODAL -->

@endsection