@extends('template')
@extends('sidebar')
@section('judul_halaman', 'Kelola Akun')
@section('content')


<div class="row text-center">
    <div class="" style="width:820px;margin-top:100px; margin-bottom:-90px; margin-left:60px">
        <div class="row" style="font-weight: bold">
            <a href="#" id="tombolpendonor" style="text-decoration: none; margin-right: 20px" class="col">
                Pendonor
            </a>
            <a href="#" id="tomboluser" style="text-decoration: none;" class="col">
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
                <input class="btn searchbar-style" type="search" name="searchpendonor" placeholder="Cari Pendonor...">
                <button type="submit" class="btn btn-dark searchicon-style">
                    <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                </button>
            </form>
        </div>

        <div class="filter btn-group">

            <button type="button" class="btn btn-dark inserticon-style" data-toggle="modal" data-target=".tambahpendonor">
                <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
            </button>

            <button class="btn btn-secondary insertbar-style" data-toggle="modal" data-target=".tambahpendonor" type="button">
                Tambah
            </button>


        </div>

        <div class="filter btn-group">
            <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterpendonor">
                <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
                <span style="font-size: 12px; color: white;">Filter</span>
            </button>
        </div>

        <div class="filter btn-group wow">
            @if(session('errorPendonor'))
            <div class="alert-container">
                <div class="alert-icon">&#9888;</div>
                <div>
                    {{ session('errorPendonor') }}
                </div>
            </div>
            @elseif(session('successPendonor'))
            <div class="alert-container1 success">
                <div class="alert-icon">&#10004;</div>
                <div>
                    {{ session('successPendonor') }}
                </div>
            </div>
            @elseif(isset($successMessage))
            <div class="alert-container12 success">
                @if($searchPendonor)
                <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                @elseif($jenisKelamin && $golonganDarah || $jenisKelamin || $golonganDarah)
                <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                @endif
                <div>
                    {{ $successMessage }}
                </div>
            </div>
            @endif
        </div>

    </div>
    <table id="tabelpendonor" class="table table-bordered">
        <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Goldar</th>
                <th scope="col">Kontak</th>
                <th scope="col">Email</th>
                <th colspan="3" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($data) == 0)
            <tr>
                <td style="font-weight:bold" colspan="11" style="text-align:center;">Data Pendonor belum ada</td>
            </tr>
            @else
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+$data->firstItem() }}</th>
                <td>{{ $row->kode_pendonor }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>{{ $row->golongandarah->nama }}</td>
                <td>{{ $row->kontak_pendonor }}</td>
                <td>{{ $row->email }}</td>
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
            @endif
        </tbody>
    </table>
    <div class="pagination1">
        {{ $data->links() }}
    </div>

    <div class="filtering" id="filteruser">
        <div class="tes2" style="margin-top:-90px;margin-left:-26px;margin-bottom:10px;">
            <div class="filter btn-group">
                <form action="/kelolaakun" method="GET" style="display: flex;">
                    <input class="btn searchbar-style" type="search" name="searchuser" placeholder="Cari User...">
                    <button type="submit" class="btn btn-dark searchicon-style">
                        <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
                    </button>
                </form>
            </div>

            <div class="filter btn-group">

                <button type="button" class="btn btn-dark inserticon-style" data-toggle="modal" data-target=".tambahuser">
                    <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
                </button>

                <button class="btn btn-secondary insertbar-style" data-toggle="modal" data-target=".tambahuser" type="button">
                    Tambah
                </button>

            </div>

            <div class="filter btn-group">
                <form action="/kelolaakun" method="GET" style="display: flex;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter berdasarkan
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                            <button class="dropdown-item" type="submit" name="sortuser" value="superadmin">Superadmin saja</button>
                            <button class="dropdown-item" type="submit" name="sortuser" value="admin">Admin saja</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="filter btn-group wow">
                @if(session('errorUser'))
                <div class="alert-container">
                    <div class="alert-icon">&#9888;</div>
                    <div>
                        {{ session('errorUser') }}
                    </div>
                </div>
                @elseif(session('successUser'))
                <div class="alert-container1 success">
                    <div class="alert-icon">&#10004;</div>
                    <div>
                        {{ session('successUser') }}
                    </div>
                </div>
                @elseif(isset($successMessageUser))
                <div class="alert-container12 success">
                    @if($searchUser)
                    <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
                    @elseif($sort)
                    <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
                    @endif
                    <div>
                        {{ $successMessageUser }}
                    </div>
                </div>
                @endif
            </div>
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
            @if(count($data1) == 0)
            <tr>
                <td colspan="8" style="font-weight: bold;text-align:center;">User belum ada</td>
            </tr>
            @else
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
            @endif
    </table>
    <div class="pagination2">
        {{ $data1->links() }}
    </div>

</div>

<!-- TABEL PENDONOR -->

<!-- MODAL INSERT PENDONOR -->
<div class="modal fade tambahpendonor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah Pendonor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
                <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/insertpendonorsuper" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="nama">Nama</label>
                                <input class="kolom form-control" name="nama" type="text" id="nama" placeholder="ex : Ibra Prakasa" required oninvalid="this.setCustomValidity('Nama Pendonor harus diisi.')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="tanggallahir">Tanggal Lahir</label>
                                <input class="kolom form-control" name="tanggal_lahir" type="date" id="tanggalLahir" required oninvalid="this.setCustomValidity('Lengkapi Tanggal Lahir terlebih dahulu.')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="password">Password</label>
                                <input class="kolom form-control" name="password" type="password" id="password" required oninvalid="this.setCustomValidity('Password minimal 8 karakter.')" oninput="this.setCustomValidity('')" minlength="8">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="beratbadan">Berat Badan</label>
                                <input class="kolom form-control" name="berat_badan" type="number" id="beratBadan" placeholder="ex : 75 Kg" required oninvalid="this.setCustomValidity('Berat Badan harus diisi.')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="goldar">Golongan Darah</label>
                                <select class="kolom form-control" name="id_golongan_darah" id="select" required oninvalid="this.setCustomValidity('Pilih Goldar Terlebih dahulu.')" oninput="this.setCustomValidity('')">
                                    <option disabled selected value="">Pilih Golongan Darah</option>
                                    @foreach($goldar as $darah)
                                    <option class="kolom form-control" value="{{ $darah->id }}">{{ $darah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="jekel">Jenis Kelamin</label>
                                <select class="kolom form-control" id="select" name="jenis_kelamin" required oninvalid="this.setCustomValidity('Pilih Jenis Kelamin Terlebih dahulu.')" oninput="this.setCustomValidity('')">
                                    <option disabled selected value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="kontak">Kontak</label>
                                <input class="kolom form-control" name="kontak_pendonor" type="number" id="kontak" placeholder="ex : 082235221771" required oninvalid="this.setCustomValidity('Kontak Pendonor harus diisi.')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="kontak">Email</label>
                                <input class="kolom form-control" name="email" type="email" id="email" placeholder="ex : ibraprakasa5@gmail.com" required oninvalid="this.setCustomValidity('Format Email tidak valid.')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat_pendonor" id="alamat" rows="3" placeholder="Jalan Tarandam III No 27b" required oninvalid="this.setCustomValidity('Alamat Pendonor harus diisi.')" oninput="this.setCustomValidity('')"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL -->

<!-- MODAL EDIT PENDONOR -->
@foreach($data as $row)
<div class="modal fade" id="editpendonor{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="nama">Nama</label>
                                <input class="kolom form-control" name="nama" type="text" id="nama" value="{{ $row->nama }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="tanggallahir">Tanggal Lahir</label>
                                <input class="kolom form-control" name="tanggal_lahir" type="date" id="tanggallahir" value="{{ $row->tanggal_lahir }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="password">Password</label>
                                <input type="text" class="kolom form-control" placeholder="Ketuk untuk mengganti password" readonly data-toggle="modal" data-target="#gantipassword{{ $row->id }}" data-dismiss="modal">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="beratbadan">Berat Badan</label>
                                <input class="kolom form-control" name="berat_badan" type="number" id="beratbadan" value="{{ $row->berat_badan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="goldar">Golongan Darah</label>
                                <select class="kolom form-control" name="id_golongan_darah" id="select">
                                    @foreach($goldar as $darah)
                                    <option class="kolom form-control" value="{{ $darah->id }}" @if($darah->id == $row->golongandarah->id) selected @endif>
                                        {{ $darah->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="jekel">Jenis Kelamin</label>
                                <select class="kolom form-control" name="jenis_kelamin">
                                    <option value="Laki-laki" @if($row->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                                    <option value="Perempuan" @if($row->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="kontak">Kontak</label>
                                <input class="kolom form-control" name="kontak_pendonor" type="number" id="kontak" value="{{ $row->kontak_pendonor }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" style="color:black; font-weight:bold">
                                <label for="kontak">Email</label>
                                <input class="kolom form-control" name="email" type="email" id="email" value="{{ $row->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat_pendonor" id="alamat" rows="3">{{ $row->alamat_pendonor }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL DELETE DONOR -->
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
                Apakah Anda yakin untuk menghapus pendonor di baris {{ $key+$data->firstItem() }}?
            </div>
            <form action="{{ route('deletependonorsuper', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
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
                <div class="form-group" style="text-align: center;">
                    @if ($row->gambar)
                    <a data-fancybox="gallery" href="{{ asset('assets/img/'.$row->gambar) }}" data-caption="{{ $row->nama }}">
                        <img src="{{ asset('assets/img/' . $row->gambar) }}" alt="" width="150" height="140" style="border-radius: 25%;">
                    </a>
                    @else
                    <img src="{{ asset('assets/img/userblue.png') }}" alt="" width="150" height="140" style="border-radius: 25%; border: 2px solid black;">
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Jenis Kelamin</label>
                            <input class="kolom form-control" name="jenis_kelamin" type="text" id="nomor" placeholder="{{ $row->jenis_kelamin }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Golongan Darah</label>
                            <input class="kolom form-control" name="goldar" type="text" id="nomor" placeholder="{{ $row->golongandarah->nama }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Berat Badan</label>
                            <input class="kolom form-control" name="berat_badan" type="text" id="nomor" placeholder="{{ $row->berat_badan }} KG" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Kontak</label>
                            <input class="kolom form-control" name="kontak_pendonor" type="text" id="nomor" placeholder="{{ $row->kontak_pendonor }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">Email</label>
                            <input class="kolom form-control" name="email" type="text" id="nomor" placeholder="{{ $row->email }}" readonly>
                        </div>
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="nomor">UPDATED_AT</label>
                            <input class="kolom form-control" name="updated_at" type="text" id="nomor" placeholder="{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="nomor">Alamat</label>
                    <textarea class="kolom form-control resizablealamat" name="alamat_pendonor" id="alamat" rows="6" style="height: 200px;" readonly>{{ $row->alamat_pendonor }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL GANTI PASSWORD PENDONOR -->
@foreach($data as $row)
<div class="modal fade" id="gantipassword{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="gantipasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Ubah Kata Sandi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updatepasswordpendonor', ['id' => $row->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="email">Kode - Nama</label>
                        <input class="kolom form-control" name="kodesxnama" type=text" id="kodexnama" value="{{ $row->kode_pendonor }}- {{ $row->nama }}" readonly>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordlama">Kata Sandi Lama</label>
                        <input class="kolom form-control" name="passwordlama" type="password" id="passwordlama" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Password Lama')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordbaru">Kata Sandi Baru</label>
                        <input class="kolom form-control" name="passwordbaru" type="password" id="passwordbaru"  required minlength="8" oninvalid="this.setCustomValidity('Masukkan Password Baru')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordkonfirmasi">Konfirmasi Kata Sandi Baru</label>
                        <input class="kolom form-control" name="passwordkonfirmasi" type="password" id="passwordkonfirmasi" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Konfirmasi Password Baru')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
                </div>
            </form>
            <!-- END MODAL -->
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->


<!-- MODALL FILTER PENDONOR -->
@foreach($data as $row)
<div class="modal fade filterpendonor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Filter Berdasarkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/kelolaakun" method="GET">
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="goldar">Golongan Darah</label>
                        <select class="kolom form-control" name="id_golongan_darah" id="goldar">
                            <option value="">-</option>
                            @foreach($goldar as $darah)
                            <option class="kolom form-control" value="{{ $darah->id }}" @if(request('id_golongan_darah')==$darah->id) selected @endif>{{ $darah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="kolom form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="">-</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!--  END MODAL  -->

<!-- MODAL INSERT USER -->
<div class="modal fade tambahuser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <input class="kolom form-control" name="name" type="text" id="nama" placeholder="ex : Ibra Prakasa" required oninvalid="this.setCustomValidity('Nama User harus diisi.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="password">Password</label>
                        <input class="kolom form-control" name="password" type="password" id="password" required oninvalid="this.setCustomValidity('Password minimal 8 karakter.')" oninput="this.setCustomValidity('')" minlength="8">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat" id="alamat" rows="3" placeholder="Jalan Tarandam III No 27b" required oninvalid="this.setCustomValidity('Alamat User harus diisi.')" oninput="this.setCustomValidity('')"></textarea>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Email</label>
                        <input class="kolom form-control" name="email" type="email" id="email" placeholder="ex : ibraprakasa5@gmail.com" required oninvalid="this.setCustomValidity('Format Email tidak valid.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="nohp" type="number" id="kontak" placeholder="ex : 082235221771" required oninvalid="this.setCustomValidity('Kontak User harus diisi.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="role">Role</label>
                        <select class="kolom form-control" name="role_id" id="select" required oninvalid="this.setCustomValidity('Pilih Role Terlebih dahulu.')" oninput="this.setCustomValidity('')">
                            <option disabled selected value="">Pilih Role</option>
                            @foreach($roles as $role)
                            <option class="kolom form-control" value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL -->

<!-- MODAL EDIT USER -->
@foreach($data1 as $row)
<div class="modal fade" id="edituser{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <select class="kolom form-control" name="role_id" id="select">
                            @foreach($roles as $role)
                            <option class="kolom form-control" value="{{ $role->id }}" @if($role->id == $row->role->id) selected @endif>
                                {{ $role->role_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL DELETE USER -->
@foreach($data1 as $key => $row)
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
                Apakah Anda yakin untuk menghapus user di baris {{ $key+$data1->firstItem() }}?
            </div>
            <form action="{{ route('deleteuser', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger modalbuttondanger-style">Hapus</button>
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
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
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
        const pagination1 = document.querySelector(".pagination1");
        const pagination2 = document.querySelector(".pagination2");

        if (idTabel === "tabelpendonor") {
            tabelpendonor.style.display = "table";
            filterpendonor.style.display = "block"; // Menampilkan filter pendonor
            tabeluser.style.display = "none";
            filteruser.style.display = "none"; // Menyembunyikan filter user
            tombolpendonor.classList.remove("tabel-mati");
            tombolpendonor.classList.add("tabel-aktif");
            tomboluser.classList.remove("tabel-aktif");
            tomboluser.classList.add("tabel-mati");
            pagination1.style.display = "block"; // Menampilkan paginasi 1
            pagination2.style.display = "none"; // Menyembunyikan paginasi 2
        } else if (idTabel === "tabeluser") {
            tabelpendonor.style.display = "none";
            filterpendonor.style.display = "none"; // Menyembunyikan filter pendonor
            tabeluser.style.display = "table";
            filteruser.style.display = "block"; // Menampilkan filter user
            tomboluser.classList.remove("tabel-mati");
            tombolpendonor.classList.remove("tabel-aktif");
            tomboluser.classList.add("tabel-aktif");
            tombolpendonor.classList.add("tabel-mati");
            pagination1.style.display = "none"; // Menyembunyikan paginasi 1
            pagination2.style.display = "block"; // Menampilkan paginasi 2
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

<script>
    function handleSelectChange() {
        var select = document.getElementById('select');
        var selectedValue = select.options[select.selectedIndex].value;

        // Jika pengguna memilih opsi, sembunyikan opsi pertama
        if (selectedValue !== "") {
            select.options[0].style.display = 'none';
        }
    }
</script>

<script>
    function checkPasswordLength() {
        var passwordInput = document.getElementById("password");
        var errorMessage = "Password minimal 8 karakter.";

        if (passwordInput.value.length < 8) {
            passwordInput.setCustomValidity(errorMessage);
        } else {
            passwordInput.setCustomValidity('');
        }
    }
</script>

@endsection