@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Kelola Akun
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="row text-center">
    <div class="" style="width:820px;margin-top:85px; margin-bottom:-90px; margin-left:60px">
        <div class="row" style="font-weight: bold">
            <a href="#" id="tombolpendonor" style="text-decoration: none; margin-right: 20px" class="col">
                Pendonor
            </a>
            <a href="#" id="tomboluser" style="text-decoration: none" class="col">
                User
            </a>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="content" id="search-results">
    <div class="tes1" id="filterpendonor" style="margin-top:-90px;margin-left:-26px;margin-bottom:10px;">
        <div class="filter btn-group">
            <form action="/kelolaakun" method="GET" style="display: flex;">
                <input class="btn" type="search" name="search" placeholder="Cari Pendonor..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
                <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
                    <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                </button>
            </form>
        </div>

        <div class="filter btn-group">

            <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".tambahpendonor" style="display:none;border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
                <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
            </button>

            <button class="btn btn-secondary" data-toggle="modal" data-target=".tambahpendonor" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
                Tambah
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
    </div>
    <table id="tabelpendonor" class="table table-bordered">
        <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">No. Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Tgl Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Goldar</th>
                <th scope="col">Kontak</th>
                <th scope="col">Email</th>
                <th colspan="3" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row->kode_pendonor }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>{{ $row->golongandarah->nama }}</td>
                <td>{{ $row->kontak_pendonor }}</td>
                <td>{{ $row->email }}</td>
                <!-- <td>{{ $row->created_at->diffForHumans() }}</td> -->
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
                    <button class="custom-button" data-toggle="modal" data-target="#infopendonor{{ $row->id }}">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="tes2" id="filteruser" style="margin-top:-90px;margin-left:-26px;margin-bottom:10px;">
        <div class="filter btn-group">
            <form action="/kelolaakun" method="GET" style="display: flex;">
                <input class="btn" type="search" name="search" placeholder="Cari User..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
                <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
                    <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                </button>
            </form>
        </div>

        <div class="filter btn-group">

            <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".tambahuser" style="display:none;border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
                <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
            </button>

            <button class="btn btn-secondary" data-toggle="modal" data-target=".tambahuser" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
                Tambah
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
    </div>
    <table id="tabeluser" class="table table-bordered" style="text-align:center">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Email</th>
                <th scope="col">Kontak</th>
                <th scope="col">Role</th>
                <th colspan="3" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($data1 as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ $row->alamat }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->nohp }}</td>
                <td>{{ $row->role->role_name }}</td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#edituser{{ $row->id }}">
                        <i class="bi bi-pencil-square" style="color:#03A13B;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deleteuser{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#editkatasandi{{ $row->id }}">
                        <i class="bi bi-file-earmark-lock" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
    </table>


</div>

<!-- TABEL PENDONOR -->

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
            <form action="/insertpendonorsuper" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nama">Nama</label>
                        <input class="kolom form-control" name="nama" type="text" id="nama" placeholder="ex : Ibra Prakasa">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="password">Password</label>
                        <input class="kolom form-control" name="password" type="text" id="password">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Golongan Darah</label>
                        <select class="kolom form-control" name="id_golongan_darah" id="goldar">
                            @foreach($goldar as $darah)
                            <option class="kolom form-control" value="{{ $darah->id }}">{{ $darah->nama }}</option>
                            @endforeach
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
            <form action="{{ route('updatependonorsuper', ['id' => $row->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nama">Nama</label>
                        <input class="kolom form-control" name="nama" type="text" id="nama" value="{{ $row->nama }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="password">Password</label>
                        <input class="kolom form-control" name="password" type="text" id="password">
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

<!-- MODAL DELETE JADWAL DONOR -->
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
            <form action="{{ route('deletependonorsuper', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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

<!-- MODAL DETAIL PENDONOR -->
@foreach($data as $key => $row)
<div class="modal fade" id="infopendonor{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Informasi Detail Pendonor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Nomor</label>
                            <input class="kolom form-control" name="kode_pendonor" type="text" id="nomor" placeholder="{{ $row->kode_pendonor }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Nama</label>
                            <input class="kolom form-control" name="nama" type="text" id="nomor" placeholder="{{ $row->nama }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Tanggal Lahir</label>
                            <input class="kolom form-control" name="tanggal_lahir" type="text" id="nomor" placeholder="{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Jenis Kelamin</label>
                            <input class="kolom form-control" name="jenis_kelamin" type="text" id="nomor" placeholder="{{ $row->jenis_kelamin }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Golongan Darah</label>
                            <input class="kolom form-control" name="goldar" type="text" id="nomor" placeholder="{{ $row->golongandarah->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Berat Badan</label>
                            <input class="kolom form-control" name="berat_badan" type="text" id="nomor" placeholder="{{ $row->berat_badan }} KG" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Kontak</label>
                            <input class="kolom form-control" name="kontak_pendonor" type="text" id="nomor" placeholder="{{ $row->kontak_pendonor }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Email</label>
                            <input class="kolom form-control" name="email" type="text" id="nomor" placeholder="{{ $row->email }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Alamat</label>
                            <textarea class="kolom form-control resizablealamat" name="alamat_pendonor" id="alamat" rows="6" style="height: 200px;" readonly>{{ $row->alamat_pendonor }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="nomor">UPDATED_AT</label>
                    <input class="kolom form-control" name="updated_at" type="text" id="nomor" placeholder="{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" style="background-color: black; border-radius:10px" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL INSERT USER -->
@foreach($data1 as $row)
<div class="modal fade tambahuser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/insertuser" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nama">Nama</label>
                        <input class="kolom form-control" name="name" type="text" id="nama" placeholder="ex : Ibra Prakasa">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="password">Password</label>
                        <input class="kolom form-control" name="password" type="password" id="password">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat" id="alamat" rows="3" placeholder="Jalan Tarandam III No 27b"></textarea>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Email</label>
                        <input class="kolom form-control" name="email" type="email" id="email" placeholder="ex : ibraprakasa5@gmail.com">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="nohp" type="number" id="kontak" placeholder="ex : 082235221771">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="role">Role</label>
                        <select class="kolom form-control" name="role_id" id="kontak">
                            @foreach($roles as $role)
                            <option class="kolom form-control" value="{{ $role->id }}">{{ $role->role_name }}</option>
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
@endforeach
<!-- END MODAL -->

<!-- MODAL EDIT USER -->
@foreach($data1 as $row)
<div class="modal fade" id="edituser{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateuser',$row->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="nama">Nama</label>
                        <input class="kolom form-control" name="name" type="text" id="nama" value="{{ $row->name }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat" id="alamat" rows="3">{{ $row->alamat }}</textarea>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="email">Email</label>
                        <input class="kolom form-control" name="email" type="email" id="email" value="{{ $row->email }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="nohp" type="number" id="kontak" value="{{ $row->nohp }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Role</label>
                        <select class="kolom form-control" name="role_id" id="kontak">
                            @foreach($roles as $role)
                            <option class="kolom form-control" value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
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

<!-- MODAL DELETE USER -->
@foreach($data1 as $row)
<div class="modal fade" id="deleteuser{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin untuk menghapus data ini?
            </div>
            <form action="{{ route('deleteuser', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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

<!-- MODAL PASSWORD-->
@foreach($data1 as $row)
<div class="modal fade" id="editkatasandi{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Ubah Kata Sandi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updatepassworduser', ['id' => $row->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="email">Email</label>
                        <input class="kolom form-control" name="email" type="email" id="email" value="{{ $row->email }}" readonly>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordlama">Kata Sandi Lama</label>
                        <input class="kolom form-control" name="passwordlama" type="password" id="passwordlama">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordbaru">Kata Sandi Baru</label>
                        <input class="kolom form-control" name="passwordbaru" type="password" id="passwordbaru">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordkonfirmasi">Konfirmasi Kata Sandi Baru</label>
                        <input class="kolom form-control" name="passwordkonfirmasi" type="password" id="passwordkonfirmasi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="background-color: #03A13B; border-radius:10px">Simpan</button>
                </div>
            </form>
            <!-- END MODAL -->
        </div>
    </div>
</div>
@endforeach

<script>
    function tampilkanTabel(idTabel) {
        const tabelpendonor = document.getElementById("tabelpendonor");
        const tabeluser = document.getElementById("tabeluser");
        const filterpendonor = document.getElementById("filterpendonor");
        const filteruser = document.getElementById("filteruser");
        const tombolpendonor = document.getElementById("tombolpendonor");
        const tomboluser = document.getElementById("tomboluser");

        if (idTabel === "tabelpendonor") {
            tabelpendonor.style.display = "table";
            filterpendonor.style.display = "block"; // Menampilkan filter pendonor
            tabeluser.style.display = "none";
            filteruser.style.display = "none"; // Menyembunyikan filter user
            tombolpendonor.classList.remove("tabel-mati");
            tombolpendonor.classList.add("tabel-aktif");
            tomboluser.classList.remove("tabel-aktif");
            tomboluser.classList.add("tabel-mati");
        } else if (idTabel === "tabeluser") {
            tabelpendonor.style.display = "none";
            filterpendonor.style.display = "none"; // Menyembunyikan filter pendonor
            tabeluser.style.display = "table";
            filteruser.style.display = "block"; // Menampilkan filter user
            tomboluser.classList.remove("tabel-mati");
            tombolpendonor.classList.remove("tabel-aktif");
            tomboluser.classList.add("tabel-aktif");
            tombolpendonor.classList.add("tabel-mati");
        }

        // Simpan status ke localStorage
        localStorage.setItem('tabelStatus', idTabel);
    }

    document.getElementById("tombolpendonor").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabelpendonor");
    });

    document.getElementById("tomboluser").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabeluser");
    });

    window.onload = function() {
        // Ambil status dari localStorage jika ada
        const status = localStorage.getItem('tabelStatus');
        if (status === 'tabeluser') {
            tampilkanTabel("tabeluser");
        } else {
            tampilkanTabel("tabelpendonor");
        }
    };
</script>



@endsection