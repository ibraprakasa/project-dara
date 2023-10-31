@extends('template')
@extends('sidebar')
@section('content')
 
<head>
    <title>
        DARA || Laporan
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>

<div class="filter btn-group">
    <form action="/laporan" method="GET" style="display: flex;">
        <input class="btn" type="search" name="search" placeholder="Cari Laporan..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>


<div class="filter btn-group">
    <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterlaporan">
        <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
        <span style="font-size: 12px; color: white;">Filter</span>
    </button>
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
                <th scope="col">KODE PELAPOR</th>
                <th scope="col">NAMA PELAPOR</th>
                <th scope="col">TEKS</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Tipe</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($report) == 0)
            <tr>
                <td style="font-weight: bold;" colspan="7" style="text-align:center;">Laporan tidak ditemukan</td>
            </tr>
            @else
            @foreach($report as $key => $laporan)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $laporan->pendonor->kode_pendonor }}</td>
                <td>{{ $laporan->pendonor->nama }}</td>
                <td class="truncate-text-report">{{ $laporan->text }}</td>
                <td>{{ $laporan->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $laporan->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>
                <td>{{ $laporan->type }}</td>
                <td>
                <button class="custom-button" data-toggle="modal" data-target="#infolaporan{{ $laporan->id_post }}-{{ $laporan->id_comment }}-{{ $laporan->id_reply }}">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $report ->links() }}

</div>

<!-- MODAL FILTER LAPORAN -->
<div class="modal fade filterlaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Filter Berdasarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/laporan" method="GET">
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
                        <label style="color:black;font-weight:bold" for="type">Jenis Laporan</label>
                        <select class="kolom form-control" name="type">
                            <option class="kolom form-control" value="">-</option>
                            <option class="kolom form-control" value="postingan">Postingan</option>
                            <option class="kolom form-control" value="komentar">Komentar</option>
                            <option class="kolom form-control" value="balasan">Balasan Komentar</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius: 10px">Terapkan</button>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  END MODAL  -->

<!-- MODAL DETAIL LAPORAN -->
@foreach($report as $key => $row)
<div class="modal fade" id="infolaporan{{ $row->id_post }}-{{ $row->id_comment }}-{{ $row->id_reply }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Informasi Detail Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" style="text-align: center;">
                    <img src="{{ $row->posts->gambar }}" alt="Gambar" width="500" height="250">
                </div>

                <label style="color:black;font-weight:bold">Status</label>
                <div class="form-group" style="color:black;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->posts->text }}</textarea>
                </div>

                <div class="form-group" style="color:black;">
                    <input type="text" class="kolom form-control" name="comment" id="comment" placeholder="{{ $row->comments->text }}" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="border-radius:10px;background-color: #E70000;" data-toggle="modal" data-dismiss="modal" data-target="#deletelaporanasli{{ $row->id_post }}">Hapus Laporan Asli</button>
                <button type="button" class="btn btn-primary" style="border-radius:10px;background-color: #3B4B65;" data-toggle="modal" data-dismiss="modal" data-target="#deletelaporanpalsu{{ $row->id_post }}">Hapus Laporan Palsu</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL DELETE LAPORAN ASLI -->
@foreach($report as $key => $row)
<div class="modal fade" id="deletelaporanpalsu{{ $row->id_post }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus laporan palsu ini ?
            </div>
            <form action="{{ route('deletelaporanpalsu', ['id' => $row->id_post]) }}" method="POST" enctype="multipart/form-data">
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

<!-- MODAL DELETE LAPORAN ASLI -->
@foreach($report as $key => $row)
<div class="modal fade" id="deletelaporanasli{{ $row->id_post }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus laporan asli beserta {{ $row->type }}nya?
            </div>
            <form action="{{ route('deletelaporanasli', ['id' => $row->id_post]) }}" method="POST" enctype="multipart/form-data">
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

@endsection