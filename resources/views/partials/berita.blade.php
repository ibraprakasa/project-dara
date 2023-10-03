@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Berita
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="filter btn-group">
    <form action="/berita" method="GET" style="display: flex;">
        @csrf
        <input class="btn" type="search" name="search" placeholder="Cari Judul Berita..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>


<div class="filter btn-group">

    <button type="button" data-toggle="modal" data-target=".tambahberita" class="btn btn-dark" style="border-radius:15px 0 0 15px;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
        <i class="bi bi-file-plus" style="font-size: 20px; color: white;"></i>
    </button>

    <button class="btn btn-secondary" data-toggle="modal" data-target=".tambahberita" type="button" style="background-color: #d9d9d9; color:black;border-radius:0 0 0 0;">
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
                <th scope="col">Gambar</th>
                <th width="150px" scope="col">Judul</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">CREATED_AT</th>
                <th colspan="2" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>
                    <img src="{{ asset('assets/img/'.$row->gambar) }}" alt="" style="width:100px; height:100px;">
                </td>
                <td>{{ $row->judul }}</td>
                <td class="truncate-text">{{ $row->deskripsi }}</td>
                <td>{{ $row->created_at->diffForHumans() }}</td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#editberita{{ $row->id }}">
                        <i class="bi bi-pencil-square" style="color:#03A13B;"></i>
                    </button>
                </td>
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#deleteberita{{ $row->id }}">
                        <i class="bi bi-trash3" style="color:#E70000;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL INSERT BERITA -->
@foreach($data as $row)
<div class="modal fade tambahberita" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tambah Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="/insertberita" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gambar" class="btn btn-primary" style="background-color: #3B4B65;">
                            <i class="col pl-1 bi bi-image"></i> Pilih Gambar
                        </label>
                        <input class="kolom form-control" name="gambar" type="file" id="gambar" style="display: none;">
                        <span id="keterangan-gambar" style="color: black; font-weight:bold">Tidak ada gambar yang dipilih</span>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="judulberita">Judul Berita</label>
                        <input class="kolom form-control" name="judul" type="text" id="judulberita" placeholder="ex: Ketersediaan Darah">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Deskripsi</label>
                        <textarea class="kolom form-control resizable" name="deskripsi" id="deskripsi" rows="5" cols="5" placeholder="......."></textarea>
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

<!-- MODAL EDIT BERITA -->
@foreach($data as $row)
<div class="modal fade" id="editberita{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Edit Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateberita', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="gambar{{ $row->id }}" class="btn btn-primary" style="background-color: #3B4B65;">
                            <i class="col pl-1 bi bi-image"></i>
                            <span style="color: white;" class="pilih-text">Pilih Gambar</span>
                        </label>
                        <input class="kolom form-control" name="gambar" type="file" id="gambar{{ $row->id }}" style="display: none;">
                        <span id="keterangan-gambar{{ $row->id }}" style="color: black;">{{ $row->gambar }}</span>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="judulberita">Judul Berita</label>
                        <input class="kolom form-control" name="judul" type="text" id="judulberita" value="{{ $row->judul }}">
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Deskripsi</label>
                        <textarea class="kolom form-control resizable" name="deskripsi" id="deskripsi" rows="5" cols="5">{{ $row->deskripsi }}
                        </textarea>
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

<!-- MODAL DELETE BERITA -->
@foreach($data as $key => $row)
<div class="modal fade" id="deleteberita{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('deleteberita', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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

<script>
    // Mendapatkan elemen input file
    var inputGambar = document.getElementById('gambar');
    // Mendapatkan elemen span keterangan
    var keteranganGambar = document.getElementById('keterangan-gambar');

    // Menambahkan event listener untuk memantau pemilihan file
    inputGambar.addEventListener('change', function() {
        if (inputGambar.files.length > 0) {
            // Jika ada file yang dipilih, update teks keterangan
            keteranganGambar.textContent = 'Gambar telah dipilih: ' + inputGambar.files[0].name;
        } else {
            // Jika tidak ada file yang dipilih, kembalikan teks keterangan ke default
            keteranganGambar.textContent = 'Tidak ada gambar yang dipilih';
        }
    });
</script>

@endsection