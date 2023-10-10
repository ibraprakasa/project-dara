@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Riwayat Donor
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="row text-center">
    <div class="col" style="margin-top:100px; margin-bottom:-70px; margin-left:40px">
        <div class="row" style="width:100%;font-weight: bold">
            <a href="#" id="tombol1" style="text-decoration: none; margin-right: 10px" class="col">
                Riwayat Donor Darah
            </a>
            <a href="#" id="tombol2" style="text-decoration: none" class="col">
                Riwayat Ambil Darah
            </a>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="waw btn-group" style="margin-top:75px; margin-bottom:-90px">
    <form action="/riwayatdonor" method="GET" style="display: flex;">
        <input class="btn" type="search" name="search" placeholder="Cari Riwayat..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-dark" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>
</div>

<div class="content">
    <table class="table table-bordered" id="tabel1" style="display:none">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Donor</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Gol. Darah</th>
                <th scope="col">Lokasi</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($riwayat_donor as $key => $rd)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $rd->nama }}</td>
                <td>{{ $rd->jumlah_donor }}</td>
                <td>{{ date('F jS, Y', strtotime($rd->tanggal_donor)) }}</td>
                <td>{{ $rd->gol_darah }}</td>
                <td>{{ $rd->lokasi_donor }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table table-bordered" id="tabel2">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Ambil</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Gol. Darah</th>
                <th scope="col">Penerima</th>
                <th scope="col">Kontak Penerima</th>
            </tr>
        </thead>
        <tbody class="waduh">
            @foreach($riwayat_ambil as $key => $rd)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $rd->nama }}</td>
                    <td>{{ $rd->jumlah_ambil }}</td>
                    <td>{{ date('F jS, Y', strtotime($rd->tanggal_ambil)) }}</td>
                    <td>{{ $rd->gol_darah }}</td>
                    <td>{{ $rd->penerima }}</td>
                    <td>{{ $rd->kontak_penerima }}</td>
                </tr>
            @endforeach
       </tbody>

        <!-- <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
        </tbody> -->
    </table>


</div>
<script>
    function tampilkanTabel(idTabel) {
        const tabel1 = document.getElementById("tabel1");
        const tabel2 = document.getElementById("tabel2");

        if (idTabel === "tabel1") {
            tabel1.style.display = "table";
            tabel2.style.display = "none";
            document.getElementById("tombol1").classList.remove("tabel-mati");
            document.getElementById("tombol1").classList.add("tabel-aktif");
            document.getElementById("tombol2").classList.remove("tabel-aktif");
            document.getElementById("tombol2").classList.add("tabel-mati");
        } else if (idTabel === "tabel2") {
            tabel1.style.display = "none";
            tabel2.style.display = "table";
            document.getElementById("tombol2").classList.remove("tabel-mati");
            document.getElementById("tombol1").classList.remove("tabel-aktif");
            document.getElementById("tombol2").classList.add("tabel-aktif");
            document.getElementById("tombol1").classList.add("tabel-mati");

        }
	// Simpan status ke localStorage
        localStorage.setItem('tabelStatus', idTabel);
    }
    document.getElementById("tombol1").addEventListener("click", function(e) {
	e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabel1");
    });

    document.getElementById("tombol2").addEventListener("click", function(e) {
	e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabel2");
    });

    window.onload = function() {
        // Ambil status dari localStorage jika ada
        const status = localStorage.getItem('tabelStatus');
        if (status === 'tabel2') {
            tampilkanTabel("tabel2");
        } else {
            tampilkanTabel("tabel1");
        }
    };
</script>



@endsection