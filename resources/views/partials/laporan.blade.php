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
    <div class="alert-container11">
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
                        <label style="color:black;font-weight:bold" for="type">Tipe</label>
                        <select class="kolom form-control" name="type">
                            <option class="kolom form-control" value="">-</option>
                            <option class="kolom form-control" value="Postingan">Postingan</option>
                            <option class="kolom form-control" value="Komentar">Komentar</option>
                            <option class="kolom form-control" value="Balasan">Balasan</option>
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
            @if($row->posts)
                @if ($row->posts->gambar != null)
                <div class="form-group" style="text-align: center;">
                    <img src="{{ asset('assets/post/'.$row->posts->gambar) }}" alt="Gambar" style="width:100px; height:100px;">
                </div>
                @endif
                @if ($row->posts->text != null)
                <label style="color:red;font-weight:bold">Postingan yang dilaporkan</label>
                <div class="form-group" style="color:black;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->posts->text }}</textarea>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->posts->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->posts->pendonor->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal Posting</label>
                            <input class="kolom form-control" placeholder="{{ $row->posts->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}" readonly>
                        </div>
                    </div>
                </div>
            @endif
                @if ($row->comments && $row->comments->text != null)
                <label style="color:red;font-weight:bold">Komentar yang dilaporkan</label>
                <div class="form-group" style="color:black;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->comments->text }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->comments->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->comments->pendonor->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal Komentar</label>
                            <input class="kolom form-control" placeholder="{{ $row->comments->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}" readonly>
                        </div>
                    </div>
                </div>
                @endif
                @if ($row->reply && $row->reply->text != null)
                <label style="color:red;font-weight:bold">Balasan Komentar yang dilaporkan</label>
                <div class="form-group" style="color:black;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->reply->text }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Kode</label>
                            <input class="kolom form-control" placeholder="{{ $row->reply->pendonor->kode_pendonor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Nama</label>
                            <input class="kolom form-control" placeholder="{{ $row->reply->pendonor->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="color:black;font-weight:bold">Tanggal Balasan</label>
                            <input class="kolom form-control" placeholder="{{ $row->reply->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}" readonly>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="border-radius:10px;background-color: #E70000;" data-toggle="modal" data-dismiss="modal" data-target="#deletelaporanasli{{ $row->id }}">Hapus Laporan Asli</button>
                <button type="button" class="btn btn-primary" style="border-radius:10px;background-color: #3B4B65;" data-toggle="modal" data-dismiss="modal" data-target="#deletelaporanpalsu{{ $row->id }}">Hapus Laporan Palsu</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL DELETE LAPORAN PALSU -->
@foreach($report as $key => $row)
<div class="modal fade" id="deletelaporanpalsu{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('deletelaporanpalsu', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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
<div class="modal fade" id="deletelaporanasli{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus {{ $row->type }} ini?
            </div>
            <form action="{{ route('deletelaporanasli', ['id' =>$row->id]) }}" method="POST" enctype="multipart/form-data">
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