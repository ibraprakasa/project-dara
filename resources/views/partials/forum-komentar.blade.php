@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Forum
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="filter btn-group">
    <form action="/getKomentar" method="GET" style="display: flex;">
        <input class="btn" type="text" name="id" value="{{ request('id') }}" hidden>
        <input class="btn" type="search" name="search" placeholder="Cari Komentar..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>

<div class="filter btn-group wow">
    @if(session('error'))
    <div class="alert-container">
        <div class="alert-icon">&#9888;</div> <!-- Ikon segitiga peringatan -->
        <div>
            {{ session('error') }}
        </div>
    </div>
    @elseif(session('success'))
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
                <th scope="col">jumlah balasan</th>
                <th scope="col">Tanggal Komentar</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
        @if(count($komentar) == 0)
        <tr>
            <td colspan="7" style="text-align:center;">Komentar belum ada</td>
        </tr>
        @else
            @foreach($komentar as $nomor => $komen)
            <tr>
                <td>{{ $nomor+1 }}</td>
                <td>{{ $komen->pendonor->kode_pendonor }}</td>
                <td>{{ $komen->pendonor->nama }}</td>
                <td>{{ $komen->text }}</td>
                <td>{{ $komen->jumlah_balasan }}</td>
                <td>{{ $komen->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $komen->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB</td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletekomentar">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>



@endsection