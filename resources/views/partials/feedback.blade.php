@extends('template')
@extends('sidebar')
@section('content')

<head>
    <title>
        DARA || Feedback
    </title>
    <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<div class="row text-center">
    <div class="col" style="margin-top:100px; margin-bottom:-70px; margin-left:40px">
        <div class="row" style="width:145%;font-weight: bold">
            <a href="#" id="tomboltestimoni" style="text-decoration: none; margin-right: 10px" class="col">
                Testimoni
            </a>
            <a href="#" id="tombolinquiries" style="text-decoration: none" class="col">
                Message
            </a>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="waw btn-group" style="margin-top:75px; margin-bottom:-90px">
    <form action="/riwayatdonor" method="GET" style="display: flex;">
        <input class="btn" type="search" name="search" placeholder="Cari Tanggapan..." style="height:42px;background-color: #d9d9d9; color:black;border-radius:15px 0 0 0;">
        <button type="submit" class="btn btn-primary" style="border-radius:0 0 15px 0;width: 22px; display: flex; justify-content: center; align-items: center; background-color: #3B4B65;">
            <i class="bi bi-search" style="font-size: 20px; color: white;"></i>
        </button>
    </form>

    <div style="display: flex; margin-left:15px;">
        <button type="submit" class="btn btn-primary filter-icon" data-toggle="modal" data-target=".filterriwayat">
            <i class="bi bi-filter" style="font-size: 20px; color: white; padding-right:10px;"></i>
            <span style="font-size: 12px; color: white;">Filter</span>
        </button>
    </div>
</div>

<div class="content">
    <table class="table table-bordered" id="tabeltestimoni">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Pendonor</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Teks</th>
                <th scope="col">Star</th>
            </tr>
        </thead>
        
    </table> 

    <table class="table table-bordered" id="tabelinquiries">
        <thead class="thead" style="background-color:#3B4B65; color:white;">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
</div>

<script>
    function tampilkanTabel(idTabel) {
        const tabeltestimoni = document.getElementById("tabeltestimoni");
        const tabelinquiries = document.getElementById("tabelinquiries");
        const pagination1 = document.querySelector(".pagination1");
        const pagination2 = document.querySelector(".pagination2");

        if (idTabel === "tabeltestimoni") {
            tabeltestimoni.style.display = "table";
            tabelinquiries.style.display = "none";
            document.getElementById("tomboltestimoni").classList.remove("tabel-mati");
            document.getElementById("tomboltestimoni").classList.add("tabel-aktif");
            document.getElementById("tombolinquiries").classList.remove("tabel-aktif");
            document.getElementById("tombolinquiries").classList.add("tabel-mati");
            pagination1.style.display = "block"; // Menampilkan paginasi 1
            pagination2.style.display = "none"; // Menyembunyikan paginasi 2
        } else if (idTabel === "tabelinquiries") {
            tabeltestimoni.style.display = "none";
            tabelinquiries.style.display = "table";
            document.getElementById("tombolinquiries").classList.remove("tabel-mati");
            document.getElementById("tomboltestimoni").classList.remove("tabel-aktif");
            document.getElementById("tombolinquiries").classList.add("tabel-aktif");
            document.getElementById("tomboltestimoni").classList.add("tabel-mati");
            pagination1.style.display = "none"; // Menyembunyikan paginasi 1
            pagination2.style.display = "block"; // Menampilkan paginasi 2

        }
        // Simpan status ke localStorage
        localStorage.setItem('tabelStatus', idTabel);
    }
    document.getElementById("tomboltestimoni").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabeltestimoni");
    });

    document.getElementById("tombolinquiries").addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah tindakan default tautan
        tampilkanTabel("tabelinquiries");
    });

    window.onload = function() {
        // Ambil status dari localStorage jika ada
        const status = localStorage.getItem('tabelStatus');
        if (status === 'tabelinquiries') {
            tampilkanTabel("tabelinquiries");
        } else {
            tampilkanTabel("tabeltestimoni");
        }
    };
</script>
@endsection