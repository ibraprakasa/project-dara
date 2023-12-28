@extends('template')
@section('judul_halaman', 'Info Pendaftar')
@section('breadcrumb','Info Pendaftar')
@section('content')

<div class="filter1 btn-group">
    <form action="/infopendaftar" method="GET" style="display: flex;">
        <input class="btn btn-primary" type="text" name="id" value="{{ request('id') }}" hidden>
        <input class="btn btn-primary searchbar-style" type="search" name="search" placeholder="Cari Pendonor...">
        <button type="submit" class="btn btn-primary searchicon-style">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>

    <div class="ml-4">
        @if(session('error'))
        <div class="alert alert-failed">
            <div class="alert-icon">&#9888;</div> 
            <div class="nowrap">
                {{ session('error') }}
            </div>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success">
            <div class="alert-icon">&#10004;</div> 
            <div class="nowrap">
                {{ session('success') }}
            </div>
        </div>
        @elseif(isset($successMessage))
        <div class="alert-filter">
            @if($successMessage)
            <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
            @endif
            <div class="nowrap">
                {{ $successMessage }}
            </div>
        </div>
        @endif
    </div>
</div>

<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered" style="text-align:center">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr class="nowrap">
                <th scope="col">#</th>
                <th scope="col">kode pendonor</th>
                <th scope="col">nama</th>
                <th scope="col">goldar</th>
                <th scope="col">kontak</th>
                <!-- <th scope="col">Status</th> -->
                <th colspan=3 scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($pendaftar) == 0)
            <tr>
                <td colspan="6" style="font-weight: bold;text-align:center;">Pendaftar belum ada</td>
            </tr>
            @else
            @foreach($pendaftar as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row['kode_pendonor'] }}</td>
                <td>{{ $row['nama'] }}</td>
                <td>{{ $row['goldar'] }}</td>
                <td>{{ $row['kontak'] }}</td>
                <!-- <td>-</td> -->
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deleteModal{{ $row['id'] }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@foreach($pendaftar as $key => $row)
<div class="modal fade" id="deleteModal{{ $row['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Apakah Anda yakin ingin menghapus data pendaftar {{ $row['kode_pendonor'] }} dengan nama {{ $row['nama'] }}
            </div>
            <form action="{{ route('deletejadwalpendonor', ['id' => $row['id']]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input name="id_jadwal" type="text" value="{{ request('id') }}" hidden />
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" style="background-color: black; border-radius:10px" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #E70000; border-radius:10px">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection