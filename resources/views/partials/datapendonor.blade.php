@extends('template')
@section('judul_halaman', 'Pendonor')
@section('breadcrumb','Pendonor')
@section('content')

<div class="filter btn-group">
    <form action="/datapendonor" method="GET">
        <input class="btn btn-primary searchbar-style" type="search" name="searchpendonor" placeholder="Cari Pendonor...">
    </form>
    <button type="button" class="btn btn-primary searchicon-style">
        <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
    </button>

    <div class="ml-4">
        <button type="button" class="btn btn-primary inserticon-style" data-toggle="modal" data-target=".tambahpendonor">
            <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
        </button>
    </div>

    <button class="btn btn-primary insertbar-style" data-toggle="modal" data-target=".tambahpendonor" type="button">
        Tambah
    </button>

    <div class="ml-4">
        <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterpendonor">
            <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
            <span style="font-size: 12px; color: white;">Filter</span>
        </button>
    </div>

    <div class="ml-4">
        @if(session('errorPendonor'))
        <div class="alert alert-failed">
            <div class="alert-icon">&#9888;</div>
            <div class="nowrap">
                {{ session('errorPendonor') }}
            </div>
        </div>
        @elseif(session('successPendonor'))
        <div class="alert alert-success">
            <div class="alert-icon">&#10004;</div>
            <div class="nowrap">
                {{ session('successPendonor') }}
            </div>
        </div>
        @elseif(isset($successMessage))
        <div class="alert-filter">
            @if($searchPendonor)
            <div class="alert-icon"><i class="bi bi-search" style="color:#22A7E0"></i></div>
            @elseif($jenisKelamin && $golonganDarah || $jenisKelamin || $golonganDarah)
            <div class="alert-icon"><img src="{{ asset('assets/img/filter.png') }}" width="24;" height="20"></div>
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
            @if(count($data) == 0)
            <tr>
                <td style="font-weight:bold" colspan="11" style="text-align:center;">Data Pendonor belum ada</td>
            </tr>
            @else
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
            @endif
        </tbody>
    </table>
</div>

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
            <form action="/insertpendonor" method="POST" enctype="multipart/form-data" autocomplete="off">
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
            <form action="{{ route('updatependonor', ['id' => $row->id]) }}" method="POST">
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
                Apakah Anda yakin untuk menghapus pendonor di baris {{ $key+$data->firstItem() }}?
            </div>
            <form action="{{ route('deletependonor', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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
                        <input class="kolom form-control" name="passwordlama" type="password" id="passwordlama" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Password Lama.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordbaru">Kata Sandi Baru</label>
                        <input class="kolom form-control" name="passwordbaru" type="password" id="passwordbaru" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Password Baru.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="passwordkonfirmasi">Konfirmasi Kata Sandi Baru</label>
                        <input class="kolom form-control" name="passwordkonfirmasi" type="password" id="passwordkonfirmasi" required minlength="8" oninvalid="this.setCustomValidity('Masukkan Konfirmasi Password Baru.')" oninput="this.setCustomValidity('')">
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
            <form action="/datapendonor" method="GET">
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

<script>
    function handleSelectChange() {
        var select = document.getElementById('select');
        var selectedValue = select.options[select.selectedIndex].value;

        if (selectedValue !== "") {
            select.options[0].style.display = 'none';
        }
    }
</script>

@endsection