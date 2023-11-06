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
            <li class="breadcrumb-item" aria-current="page"><a href="#" id="komentarLink">Komentar</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Balasan</a></li>
        </ol>
    </nav>
</div>

<div class="filte btn-group">
    @foreach($balas as $row)
    <form action="{{ route('forum-balasan', ['id_comment' => $row->id_comment]) }}" method="GET" style="display: flex;">
    <input type="hidden" name="id" value="{{ $row->id }}">
    @endforeach
        <input class="btn" type="search" name="search" placeholder="Cari Balasan..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>

<div class="filte btn-group">
    <button type="button" class="btn btn-primary filter-icon" data-toggle="modal" data-target="#filterbalasan">
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
    @endif
</div>

<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered" style="text-align:center">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">kode_pendonor</th>
                <th scope="col">nama</th>
                <th scope="col">teks</th>
                <th scope="col">Tanggal Balasan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($balas) == 0)
            <tr>
                <td style="font-weight:bold" colspan="6" style="text-align:center;">Balasan belum ada</td>
            </tr>
            @else
            @foreach($balas as $nomor => $row)
            <tr>
                <td>{{ $nomor+$balas->firstItem() }}</td>
                <td>{{ $row->pendonor->kode_pendonor }}</td>
                <td>{{ $row->pendonor->nama }}</td>
                <td>{{ $row->text }}</td>
                <td>{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletebalasan{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $balas ->links() }}
</div>

<!-- MODAL DELETE BALASAN -->
@foreach($balas as $nomor => $row)
<div class="modal fade" id="deletebalasan{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus balasan komentar ke-{{ $nomor+$balas->firstItem() }}?
            </div>
            <form action="{{ route('deletebalasan', ['id' => $row->id, 'comment_id' => request('id')]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $row->id }}">
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

<!-- MODAL FILTER BALASAN -->
<div class="modal fade" id="filterbalasan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @foreach($balas as $row)
            <form action="{{ route('forum-balasan', ['id_comment' => $row->id_comment]) }}" method="GET">
            <input type="hidden" name="id" value="{{ $row->id }}">
            @endforeach
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