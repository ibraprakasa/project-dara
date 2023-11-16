@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Stok Darah
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="filter1 btn-group">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".tambahstokdarah" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" data-toggle="modal" data-target=".tambahstokdarah" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
        Tambah
    </button>
</div>

<div class="filter1 btn-group">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".ambilstokdarah" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-minus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" data-toggle="modal" data-target=".ambilstokdarah" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
        Ambil
    </button>
</div>

<div class="filter1 btn-group wow">
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
    <table class="table table-bordered">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Golongan Darah</th>
                <th scope="col">Jumlah</th>
                <th scope="col">UPDATE_AT</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($data) == 0)
            <tr>
                <td style="font-weight: bold;" colspan="4" style="text-align:center;">Stok Darah belum ada</td>
            </tr>
            @else
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>{{ $row->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade tambahstokdarah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah Stok Donor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/insertstok" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Pendonor</label>
                        <select class="kolom form-control" name="kode_pendonor" id="goldar">
                            @foreach($kode_pendonor as $kp)
                            <option class="kolom form-control" value="{{ $kp->kode_pendonor }}">{{ $kp->kode_pendonor }} - {{ $kp->nama }} - {{ $kp->golongandarah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Jumlah Kantong</label>
                        <input class="kolom form-control" name="jumlah" type="number" id="jumlah" placeholder="ex : 5" required>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="lokasi">Lokasi</label>
                        <select class="kolom form-control" name="lokasi" id="lokasi">
                            @foreach($lokasi as $lp)
                            <option class="kolom form-control" value="{{ $lp->lokasi }}">{{ $lp->lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius:10px">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL -->

<!-- MODAL AMBIL -->
@foreach($data as $row)
<div class="modal fade ambilstokdarah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Ambil Stok Donor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/updatestok" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Pendonor</label>
                        <select class="kolom form-control" name="kode_pendonor" id="goldar">
                            @foreach($kode_pendonor as $kp)
                            <option class="kolom form-control" value="{{ $kp->kode_pendonor }}">{{ $kp->kode_pendonor }} - {{ $kp->nama }} - {{ $kp->golongandarah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Jumlah Ambil Kantong</label>
                        <input class="kolom form-control" name="jumlah" type="number" id="jumlah" placeholder="ex : 5">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Penerima</label>
                        <input class="kolom form-control" name="penerima" type="text" id="penerima" placeholder="ex : Ibra Prakasa">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Kontak</label>
                        <input class="kolom form-control" name="kontak" type="number" id="kontak" placeholder="ex : 0822******">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius:10px">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->


@endsection