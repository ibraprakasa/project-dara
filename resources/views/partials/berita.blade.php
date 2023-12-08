@extends('template')
@extends('sidebar')

@section('judul_halaman', 'Berita')

@section('content')


<div class="filter btn-group">
    <form action="/berita" method="GET" style="display: flex;">
        @csrf
        <input class="btn searchbar-style" type="search" name="search" placeholder="Cari Judul...">
        <button type="submit" class="btn btn-dark searchicon-style">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>

    <div class="ml-4">
        <button type="button" data-toggle="modal" data-target=".tambahberita" class="btn btn-dark inserticon-style">
            <i class="bi bi-file-plus " style="font-size: 20px; color: white;"></i>
        </button>

    </div>

    <button class="btn btn-secondary insertbar-style" data-toggle="modal" data-target=".tambahberita" type="button">
            Tambah
        </button>

    <div class="ml-4">
    <button type="button" class="btn btn-primary filter-icon" data-toggle="modal" data-target="#filterberita">
        <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
        <span style="font-size: 12px; color: white;">Filter</span>
    </button>
    </div>
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
                <th scope="col">Gambar</th>
                <th width="150px" scope="col">Judul</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Tanggal Berita</th>
                <th colspan="3" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @if(count($data) == 0)
            <tr>
                <td colspan="7" style="font-weight:bold;text-align:center;">Berita belum ada</td>
            </tr>
            @else
            @foreach($data as $key => $row)
            <tr>
                <th scope="row">{{ $key+$data->firstItem() }}</th>
                <td>
                    <a data-fancybox="gallery" href="{{ asset('assets/img/'.$row->gambar) }}" data-caption="{{ $row->judul }}">
                        <img src="{{ asset('assets/img/'.$row->gambar) }}" alt="" width="100px" height="100px">
                    </a>
                </td>
                <td class="truncate-text1">{{ $row->judul }}</td>
                <td class="truncate-text">{{ $row->deskripsi }}</td>
                <td>{{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('l, j F Y') }}<br>
                    {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('H:i') }} WIB
                </td>               
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
                <td>
                    <button class="custom-button" data-toggle="modal" data-target="#infoberita{{ $row->id }}">
                        <i class="bi bi-info-square" style="color:black;"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{ $data ->links() }}

</div>

<!-- MODAL INSERT BERITA -->
<div class="modal fade tambahberita" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <div class="d-flex align-items-center">
                            <label for="gambar" class="btn btn-primary" style="background-color: #3B4B65;">
                                <i class="col pl-1 bi bi-image"></i> Pilih Gambar
                            </label>
                            <div class="col">
                                <input class="kolom form-control" name="gambar" type="file" id="gambar" required accept=".jpg, .jpeg, .png, .svg, .webp" oninvalid="this.setCustomValidity('Masukkan Gambar terlebih dahulu.')" oninput="this.setCustomValidity('')">
                                <span id="keterangan-gambar" style="color: black; font-weight:bold">Tidak ada gambar yang dipilih</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="judulberita">Judul Berita</label>
                        <textarea class="kolom form-control" name="judul" type="text" id="judulberita" placeholder="ex: Ketersediaan Darah" required oninvalid="this.setCustomValidity('Judul Berita harus diisi.')" oninput="this.setCustomValidity('')"></textarea>
                    </div>
                    <div class="form-group" style="color:black; font-weight:bold">
                        <label for="alamat">Deskripsi</label>
                        <textarea class="kolom form-control resizable" name="deskripsi" id="deskripsi" rows="5" cols="5" placeholder="......." required oninvalid="this.setCustomValidity('Deskripsi Berita harus diisi.')" oninput="this.setCustomValidity('')"></textarea>
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

<!-- MODAL EDIT BERITA -->
@foreach($data as $row)
<div class="modal fade" id="editberita{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <div class="d-flex align-items-center">
                            <label for="gambar{{ $row->id }}" class="btn btn-primary" style="background-color: #3B4B65;">
                                <i class="col pl-1 bi bi-image"></i>
                                <span style="color: white;" class="pilih-text">Pilih Gambar</span>
                            </label>
                            <div class="col">
                                <input class="kolom form-control" name="gambar" type="file" id="gambar{{ $row->id }}" style="display: none;">
                                <span id="keterangan-gambar{{ $row->id }}" style="color: black;">Gambar yang dipilih : {{ $row->gambar }}</span>
                            </div>
                        </div>
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
                    <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
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
                Apakah Anda yakin untuk menghapus berita di baris {{ $key+$data->firstItem() }}?
            </div>
            <form action="{{ route('deleteberita', ['id' => $row->id]) }}" method="POST" enctype="multipart/form-data">
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

<!-- MODAL INFO BERITA -->
@foreach($data as $key => $row)
<div class="modal fade" id="infoberita{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black; font-weight: bold;" class="modal-title" id="exampleModalLabel">Detail Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="berita-title" for="judulberita">{{ $row->judul }}</label><br>
                <div class="form-group" style="text-align: center;">
                    <a data-fancybox="gallery" href="{{ asset('assets/img/'.$row->gambar) }}" data-caption="{{ $row->judul }}">
                        <img src="{{ asset('assets/img/'.$row->gambar) }}" alt="" width="500" height="250">
                    </a>
                </div>
                <label style="color:#3B4B65;font-weight:bold;">Deskripsi</label>
                <div class="form-group" style="color:black;background-color: white;">
                    <textarea class="kolom form-control resizablestatus" rows="6" readonly>{{ $row->deskripsi }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
<!-- END MODAL -->

<!-- MODAL FILTER POSTINGAN -->
<div class="modal fade" id="filterberita" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('berita') }}" method="GET">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success modalbuttonsuccess-style">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  END MODAL  -->

<script>
    // Mendapatkan elemen input file
    var inputGambar = document.getElementById('gambar');
    // Mendapatkan elemen span keterangan
    var keteranganGambar = document.getElementById('keterangan-gambar');

    // Menambahkan event listener untuk memantau pemilihan file
    inputGambar.addEventListener('change', function() {
        if (inputGambar.files.length > 0) {
            // Jika ada file yang dipilih, update teks keterangan
            keteranganGambar.textContent = 'Gambar telah dipilih : ' + inputGambar.files[0].name;
        } else {
            // Jika tidak ada file yang dipilih, kembalikan teks keterangan ke default
            keteranganGambar.textContent = 'Tidak ada gambar yang dipilih';
        }
    });
</script>

<?php foreach ($data as $row) : ?>
    <script>
        var inputGambar<?php echo $row->id; ?> = document.getElementById('gambar<?php echo $row->id; ?>');
        var keteranganGambar<?php echo $row->id; ?> = document.getElementById('keterangan-gambar<?php echo $row->id; ?>');

        // Menambahkan event listener untuk memantau pemilihan file
        inputGambar<?php echo $row->id; ?>.addEventListener('change', function() {
            if (inputGambar<?php echo $row->id; ?>.files.length > 0) {
                // Jika ada file yang dipilih, update teks keterangan
                keteranganGambar<?php echo $row->id; ?>.textContent = 'Gambar telah diganti : ' + inputGambar<?php echo $row->id; ?>.files[0].name;
            } else {
                // Jika tidak ada file yang dipilih, kembalikan teks keterangan ke default
                keteranganGambar<?php echo $row->id; ?>.textContent = 'Tidak ada gambar yang dipilih';
            }
        });
    </script>
<?php endforeach; ?>

<!-- @foreach($data as $row)
<script>
    var inputGambar{{ $row->id }} = document.getElementById('gambar{{ $row->id }}');
    var keteranganGambar{{ $row->id }} = document.getElementById('keterangan-gambar{{ $row->id }}');

    // Menambahkan event listener untuk memantau pemilihan file
    inputGambar{{ $row->id }}.addEventListener('change', function() {
        if (inputGambar{{ $row->id }}.files.length > 0) {
            // Jika ada file yang dipilih, update teks keterangan
            keteranganGambar{{ $row->id }}.textContent = 'Gambar telah dipilih: ' + inputGambar{{ $row->id }}.files[0].name;
        } else {
            // Jika tidak ada file yang dipilih, kembalikan teks keterangan ke default
            keteranganGambar{{ $row->id }}.textContent = 'Tidak ada gambar yang dipilih';
        }
    });
</script>
@endforeach -->




@endsection