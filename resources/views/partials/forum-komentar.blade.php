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