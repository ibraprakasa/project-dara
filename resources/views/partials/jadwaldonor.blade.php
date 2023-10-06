@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Jadwal Donor
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="filter btn-group">
    <form action="/jadwaldonor" method="GET" style="display: flex;">
        <input class="btn" type="search" name="search" placeholder="Cari Lokasi..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>

<div class="filter btn-group">

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target=".tambahjadwaldonor" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target=".tambahjadwaldonor" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
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



<div class="content" style="margin-top: 20px;">
    <table class="table table-bordered" style="text-align:center">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Alamat</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam Mulai</th>
                <th scope="col">Jam Selesai</th>
                <th scope="col">Kontak</th>
                <th scope="col">Pendaftar</th>
                <!-- <th scope="col">Status</th> -->
                <th colspan=3 scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+$data->firstItem() }}</th>
                <td>{{ $row->lokasi }}</td>
                <td class="truncate-text">{{ $row->alamat }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_donor)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->jam_mulai)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->jam_selesai)->format('H:i') }}</td>
                <td>{{ $row->kontak }}</td>
                <td>{{ $row->jumlah_pendonor }}</td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#editjadwaldonor{{ $row->id }}">
                        <i class="bi bi-pencil-square" style="color:#03A13B;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deletejadwaldonor{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
                <td>
                <form action="/infopendaftar" method="GET" style="display: flex;">
                    <input class="btn" type="text" value="{{  $row->id }}" name="id" hidden/>
                    <button class="custom-button" type="submit">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data ->links() }}

</div>

<!-- MODAL INSERT JADWAL DONOR -->
<div class="modal fade tambahjadwaldonor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah Jadwal Donor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/insertjadwaldonor" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="namalokasi">Nama Lokasi</label>
                        <input class="kolom form-control" type="text" name="lokasi" id="namalokasi" placeholder="ex: Politeknik Negeri Padang">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat" id="alamat" rows="3" placeholder="Jalan Tarandam III No 27b"></textarea>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="tanggal">Tanggal</label>
                        <input class="kolom form-control" name="tanggal_donor" type="date" id="tanggal">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jammulai">Jam Mulai</label>
                        <input class="kolom form-control" name="jam_mulai" type="time" id="jammulai">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jamselesai">Jam Selesai</label>
                        <input class="kolom form-control" name="jam_selesai" type="time" id="jamselesai">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="kontak" type="number" id="kontak" placeholder="ex : 082235221771">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah_pendonor">Jumlah Pendonor</label>
                        <input class="kolom form-control" name="jumlah_pendonor" type="number" id="jumlahpendonor" placeholder="20">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="longitude">Longitude</label>
                        <input class="kolom form-control" name="longitude" type="number" id="longitude" name="longitude" step="any"  placeholder="ex : xx.xxx" required>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="latitude">Latitude</label>
                        <input class="kolom form-control" name="latitude" type="number" id="latitude" name="latitude" step="any"  placeholder="ex : xx.xxx" required>
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

<!-- MODAL EDIT JADWAL DONOR -->
@foreach($data as $row)
<div class="modal fade" id="editjadwaldonor{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Edit Jadwal Donor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <form action="{{ route('updatejadwaldonor', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="namalokasi">Nama Lokasi</label>
                        <input class="kolom form-control" name="lokasi" type="text" id="namalokasi" value="{{ $row->lokasi }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Alamat</label>
                        <textarea class="kolom form-control" name="alamat" id="alamat" rows="3">{{ $row->alamat }}
                        </textarea>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="tanggal">Tanggal</label>
                        <input class="kolom form-control" name="tanggal_donor" type="date" id="tanggal" value="{{ $row->tanggal_donor }}"> 
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jammulai">Jam Mulai</label>
                        <input class="kolom form-control" name="jam_mulai" type="time" id="jammulai" value="{{ $row->jam_mulai }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jamselesai">Jam Selesai</label>
                        <input class="kolom form-control" name="jam_selesai" type="time" id="jamselesai" value="{{ $row->jam_mulai }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="kontak">Kontak</label>
                        <input class="kolom form-control" name="kontak" type="number" id="kontak" value="{{ $row->kontak }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah_pendonor">Jumlah Pendonor</label>
                        <input class="kolom form-control" name="jumlah_pendonor" type="number" id="jumlahpendonor"value="{{ $row->jumlah_pendonor }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="longitude">Longitude</label>
                        <input class="kolom form-control" type="number" id="longitude" name="longitude" value="{{ $row->longitude }}" required>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="latitude">Latitude</label>
                        <input class="kolom form-control" type="number" id="latitude" name="latitude" value="{{ $row->latitude }}" required>
                    </div>
                    <!-- <div class="form-group" style="color:black; font-weight:bold">
                        <label for="status">Status</label>
                        <select class="kolom form-control" id="status" ">
                            <option class="kolom form-control" value="default">Belum Selesai</option>
                            <option class="kolom form-control" value="selesai">Selesai</option>
                        </select>
                    </div> -->
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
<div class="modal fade" id="deletejadwaldonor{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('deletejadwaldonor', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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
