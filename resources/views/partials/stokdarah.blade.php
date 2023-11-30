@extends('template')
@extends('sidebar')

@section('judul_halaman', 'Stok Darah')
@section('content')


<div class="filter1 btn-group">
    <button type="button" class="btn btn-dark inserticon-style" data-toggle="modal" data-target=".tambahstokdarah">
        <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary insertbar-style" data-toggle="modal" data-target=".tambahstokdarah" type="button">
        Tambah
    </button>
</div>

<div class="filter1 btn-group">
    <button type="button" class="btn btn-dark ambilicon-style" data-toggle="modal" data-target=".ambilstokdarah">
        <i class="bi bi-file-minus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary ambilbar-style" data-toggle="modal" data-target=".ambilstokdarah" type="button" >
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
        <thead class="thead thead-style">
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
<div class="modal fade tambahstokdarah" id="modaltambahstokdarah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="goldar" style="color:black; font-weight:bold">Pendonor</label>
                        <select class="kolom form-control" name="kode_pendonor" id="selectPendonor" required oninvalid="this.setCustomValidity('Pilih Pendonor terlebih dahulu.')" oninput="this.setCustomValidity('')">
                        <option disabled selected value="" >Pilih Pendonor</option>
                            @foreach($kode_pendonor as $kp)
                            <option class="kolom form-control" value="{{ $kp->kode_pendonor }}">{{ $kp->kode_pendonor }} - {{ $kp->nama }} - {{ $kp->golongandarah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lokasi" style="color:black; font-weight:bold">Lokasi</label>
                        <select class="kolom form-control" name="lokasi" id="selectLokasi" required required oninvalid="this.setCustomValidity('Pilih Lokasi Donor terlebih dahulu.')" oninput="this.setCustomValidity('')">
                            <option disabled selected value="" >Pilih Lokasi</option>
                            @foreach($lokasi as $lp)
                            <option class="kolom form-control" value="{{ $lp->lokasi }}">{{ $lp->lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Jumlah Kantong</label>
                        <input class="kolom form-control" name="jumlah" type="number" id="jumlah" placeholder="ex : 5"  required oninvalid="this.setCustomValidity('Jumlah Kantong harus diisi.')" oninput="this.setCustomValidity('')">
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

<!-- MODAL AMBIL -->
@foreach($data as $row)
<div class="modal fade ambilstokdarah" id="modalambilstokdarah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="goldar" style="color:black; font-weight:bold">Pendonor</label>
                        <select class="kolom form-control" name="kode_pendonor" id="selectPendonorAmbil" required oninvalid="this.setCustomValidity('Pilih Pendonor terlebih dahulu.')" oninput="this.setCustomValidity('')">
                            <option disabled selected value="" >Pilih Pendonor</option>
                            @foreach($kode_pendonor as $kp)
                            <option class="kolom form-control" value="{{ $kp->kode_pendonor }}">{{ $kp->kode_pendonor }} - {{ $kp->nama }} - {{ $kp->golongandarah->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Jumlah Ambil Kantong</label>
                        <input class="kolom form-control" name="jumlah" type="number" id="jumlah" placeholder="ex : 5" required oninvalid="this.setCustomValidity('Jumlah Kantong harus diisi.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Penerima</label>
                        <input class="kolom form-control" name="penerima" type="text" id="penerima" placeholder="ex : Ibra Prakasa" required oninvalid="this.setCustomValidity('Penerima harus diisi.')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="jumlah">Kontak</label>
                        <input class="kolom form-control" name="kontak" type="number" id="kontak" placeholder="ex : 0822******" required oninvalid="this.setCustomValidity('Kontak Lokasi harus diisi.')" oninput="this.setCustomValidity('')">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $("#selectPendonor").select2({
            placeholder : 'Pilih Pendonor',
            dropdownParent : $('#modaltambahstokdarah'),
            width: '100%', // Atur lebar sesuai kebutuhan
            allowClear: true,
            theme: "bootstrap"
        });
        $("#selectLokasi").select2({
            placeholder : 'Pilih Lokasi',
            dropdownParent : $('#modaltambahstokdarah'),
            width : '100%',
            allowClear : true,
            theme: "bootstrap"
        });
        $("#selectPendonorAmbil").select2({
            placeholder : 'Pilih Pendonor',
            dropdownParent : $('#modalambilstokdarah'),
            width: '100%', // Atur lebar sesuai kebutuhan
            allowClear: true,
            theme: "bootstrap"
        });
    });
</script>

@endsection