@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Pendonor
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="filter btn-group">
    <form action="#" method="GET">
        <input class="btn" type="search" name="search" placeholder="Cari Pendonor..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
    </form>
    <button type="button" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
    </button>
</div>

<div class="filter btn-group">

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".tambahpendonor" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
        Tambah
    </button>

</div>

<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered" style="text-align:center">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">No. Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Tgl Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Goldar</th>
                <th scope="col">BB</th>
                <th scope="col">Kontak</th>
                <th scope="col">Email</th>
                <th scope="col">Alamat</th>
                <th scope="col">UPDATE_AT</th>
                <th colspan="3" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row->kode_pendonor }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->tanggal_lahir }}</td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>{{ $row->golongandarah->nama }}</td>
                <td>{{ $row->berat_badan }} KG</td>
                <td>{{ $row->kontak_pendonor }}</td>
                <td>{{ $row->email}}</td>
                <td>{{ $row->alamat_pendonor }}</td>
                <td>{{ $row->created_at->diffForHumans() }}</td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#editpendonor{{ $row->id }}">
                        <i class="bi bi-pencil-square" style="color:#03A13B;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletependonor{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target=".infopendonor">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL INSERT PENDONOR -->
@foreach($data as $row)
<div class="modal fade tambahpendonor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah Pendonor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/insertpendonor" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nama">Nama</label>
                        <input class="kolom form-control" name="nama" type="text" id="nama" placeholder="ex : Ibra Prakasa">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="password">Password</label>
                        <input class="kolom form-control" name="password" type="password" id="password" placeholder="******">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Golongan Darah</label>
                        <select class="kolom form-control" name="id_golongan_darah" id="goldar">
                            <option class="kolom form-control" value="5">A</option>
                            <option class="kolom form-control" value="6">B</option>
                            <option class="kolom form-control" value="7">AB</option>
                            <option class="kolom form-control" value="4">O</option>
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="kontak_pendonor" type="number" id="kontak" placeholder="ex : 082235221771">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Email</label>
                        <input class="kolom form-control" name="email" type="email" id="email" placeholder="ex : ibraprakasa5@gmail.com">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="tanggallahir">Tanggal Lahir</label>
                        <input class="kolom form-control" name="tanggal_lahir" type="date" id="tanggallahir">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jekel">Jenis Kelamin</label>
                        <select class="kolom form-control" id="jekel" name="jenis_kelamin">
                            <option class="kolom form-control" value="-" selected>-</option>
                            <option class="kolom form-control" value="laki-laki">Laki-Laki</option>
                            <option class="kolom form-control" value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="beratbadan">Berat Badan</label>
                        <input class="kolom form-control" name="berat_badan" type="text" id="beratbadan" placeholder="ex : 75 Kg" required>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat_pendonor" id="alamat" rows="3" placeholder="Jalan Tarandam III No 27b"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius:10px">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL EDIT PENDONOR -->
@foreach($data as $row)
<div class="modal fade" id="editpendonor{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Edit Pendonor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updatependonor', ['id' => $row->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nama">Nama</label>
                        <input class="kolom form-control" name="nama" type="text" id="nama" value="{{ $row->nama }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="password">Password</label>
                        <input class="kolom form-control" name="password" type="text" id="password" placeholder="*********">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="kontak_pendonor" type="number" id="kontak" value="{{ $row->kontak_pendonor }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="email">Email</label>
                        <input class="kolom form-control" name="email" type="email" id="email" value="{{ $row->email }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="tanggallahir">Tanggal Lahir</label>
                        <input class="kolom form-control" name="tanggal_lahir" type="date" id="tanggallahir" value="{{ $row->tanggal_lahir }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="beratbadan">Berat Badan</label>
                        <input class="kolom form-control" name="berat_badan" type="text" id="beratbadan" value="{{ $row->berat_badan }}" required>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat_pendonor" id="alamat" rows="3">{{ $row->alamat_pendonor }}</textarea>
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

<!-- MODAL DELETE PENDONOR -->
@foreach($data as $key => $row)
<div class="modal fade" id="deletependonor{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Apakah Anda yakin untuk menghapus data di baris {{ $key+1 }}?
            </div>
            <form action="{{ route('deletependonor', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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