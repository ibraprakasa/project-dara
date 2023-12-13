@extends('template')
@section('sidebar')
<div class="sidebar"  data-color="white" data-active-color="danger">
    <div class="logo" style="margin-left:2px">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="../assets/img/daraicon.png">
            </div>
        </a>
        <a href="{{ route('akun') }}" class="simple-text logo-normal" style="font-weight:bold; font-size: 14px;">
            Hi, {{ Auth::user()->name }} !
        </a>
    </div>
    
    <div class="sidebar-wrapper" style="background-color:#3B4B65; overflow:auto; height:100vh">
        <ul class="nav">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" style="color: white !important; font-weight:bold;">
                    <i class="nc-icon nc-bank" style="color: white; font-weight:bold;"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            </li>
            <li class="{{ request()->routeIs('stokdarah') ? 'active' : '' }}">
                <a href="{{ route('stokdarah') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-droplet-half" style="color: white; font-weight:bold"></i>
                    <p>Stok Darah</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            <li class="{{ request()->routeIs('riwayatdonor') ? 'active' : '' }}">
                <a href="{{ route('riwayatdonor') }}" style="color: #FFFF; font-weight:bold;">
                    <i class="bi bi-hourglass-split" style="color: white; font-weight:bold;"></i>
                    <p>Riwayat</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            <li class="active">
                <a href="{{ route('jadwaldonor') }}" style="color: white; font-weight:bold; ">
                    <i class="bi bi-calendar-event" style="color: white; font-weight:bold;"></i>
                    <p>Jadwal</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            <li class="{{ request()->routeIs('berita') ? 'active' : '' }}">
                <a href="{{ route('berita') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-newspaper" style="color: white; font-weight:bold;"></i>
                    <p>Berita</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            @if(auth()->user()->role_id == '1')
            <li class="{{ request()->routeIs('kelolaakun') ? 'active' : '' }}">
                <a href="{{ route('kelolaakun') }}" style="color: white; font-weight:bold;">
                    <i class="nc-icon nc-tile-56" style="color: white; font-weight:bold;"></i>
                    <p>Kelola Akun</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            @elseif(auth()->user()->role_id == '2')
            <li class="{{ request()->routeIs('datapendonor') ? 'active' : '' }}">
                <a href="{{ route('datapendonor') }}" style="color: white; font-weight:bold;">
                    <i class="nc-icon nc-tile-56" style="color: white; font-weight:bold;"></i>
                    <p>Data Pendonor</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            @endif
            @if(auth()->user()->role_id == '1')
            <li class="{{ request()->routeIs('forum-postingan', 'forum-komentar','forum-balasan') ? 'active' : '' }}">
                <a href="{{ route('forum-postingan') }}" style="color: white; font-weight:bold;">
                    <i class="fa fa-comments" style="color: white; font-weight:bold;"></i>
                    <p>Forum</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            <li class="{{ request()->routeIs('laporan') ? 'active' : '' }}">
                <a href="{{ route('laporan') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-file-earmark-text-fill" style="color: white; font-weight:bold;"></i>
                    <p>Laporan</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            <li class="{{ request()->routeIs('feedback') ? 'active' : '' }}">
                <a href="{{ route('feedback') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-star-fill" style="color: white; font-weight:bold;"></i>
                    <p>Tanggapan</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            @endif
            <li class="{{ request()->routeIs('akun') ? 'active' : '' }}">
                <a href="{{ route('akun') }}" style="color: white; font-weight:bold;">
                    <i class="nc-icon nc-single-02" style="color: white; font-weight:bold;"></i>
                    <p>Akun Saya</p>
                </a>
            </li>
            <hr class="jaraksidebar">
            <li>
                <a href="#logoutdara" style="color: white; font-weight:bold;" data-toggle="modal" data-target=".logoutdara">
                    <i class="bi bi-box-arrow-left whitebold" style="color: white; font-weight:bold;"></i>
                    <p>Keluar</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:3px">
            <li class="active-pro">
                <div class="text-center gambar">
                    <img src="../assets/img/logopmi.png" alt="">
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="modal fade logoutdara" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 style="color:black; font-weight: bold;" class="modal-title" id="titlemodal">Pemberitahuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"">
              <span aria-hidden=" true">&times;</span>
                </button>
            </div>
            <form action="{{ route('logoutaksi') }}" method="POST">
                @csrf
                <div class="modal-body" style="color:red;">
                    Apakah Anda yakin ingin keluar dari akun Anda?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger modalbuttondanger-style">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('judul_halaman', 'Jadwal Donor')
@section('content')


<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('jadwaldonor') }}">Jadwal</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit Jadwal</li>
        </ol>
    </nav>
</div>

<div class="container mt-3 ml-3">
    <form action="{{ route('updatejadwaldonor', ['id' => $jadwalDonor->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="col">
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="namalokasi">Nama Lokasi</label>
                    <input class="kolom form-control" type="text" name="lokasi" id="namalokasi" value="{{ $jadwalDonor->lokasi }}">
                </div>
            </div>
            <div class="col">
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="kontak">Kontak</label>
                    <input class="kolom form-control" name="kontak" type="number" id="kontak" value="{{ $jadwalDonor->kontak }}">
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="tanggal">Tanggal</label>
                    <input class="kolom form-control" name="tanggal_donor" type="date" id="tanggal" value="{{ $jadwalDonor->tanggal_donor }}">
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="jammulai">Jam Mulai</label>
                            <input class="kolom form-control" name="jam_mulai" type="time" id="jammulai" value="{{ $jadwalDonor->jam_mulai }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="jamselesai">Jam Selesai</label>
                            <input class="kolom form-control" name="jam_selesai" type="time" id="jamselesai" value="{{ $jadwalDonor->jam_selesai }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col mt-3">
                <div id="mapEdit{{ $jadwalDonor->id }}" style="height: 262px;"></div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="alamat">Alamat</label>
                            <textarea class="kolom form-control" name="alamat" id="alamat" rows="3">{{ $jadwalDonor->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="latitude">Latitude</label>
                            <input class="kolom form-control" name="latitude" type="double" id="latitude" name="latitude" step="any" value="{{ $jadwalDonor->latitude }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="longitude">Longitude</label>
                            <input class="kolom form-control" name="longitude" type="double" id="longitude" name="longitude" step="any" value="{{ $jadwalDonor->longitude }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-success modalbuttonsuccess-style">Simpan</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0DnOUYUBmubrtiYkon5_68Q8V8L2rfn8&callback=initMap&v=weekly" defer></script>

<script>
    $(document).ready(function() {
        const mapId = 'mapEdit<?php echo $jadwalDonor->id ?>';
        const latitude = <?php echo $jadwalDonor->latitude ?>;
        const longitude = <?php echo $jadwalDonor->longitude ?>;
        const lokasi = "<?php echo $jadwalDonor->lokasi ?>";

        waitForGoogleMaps(() => {
            initMap(mapId, latitude, longitude, lokasi);
        });
    });

    function waitForGoogleMaps(callback) {
        if (typeof google !== 'undefined') {
            callback();
        } else {
            setTimeout(() => {
                waitForGoogleMaps(callback);
            }, 200);
        }
    }

    function initMap(mapId, latitude, longitude, lokasi) {
        const editLatitudeInput = document.getElementById("latitude");
        const editLongitudeInput = document.getElementById("longitude");

        const myLatlng = {
            lat: latitude,
            lng: longitude
        };
        const map = new google.maps.Map(document.getElementById(mapId), {
            zoom: 15,
            center: myLatlng,
        });

        // Create a marker
        const marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: lokasi,
            draggable: true,
        });

        // Create an info window for the marker
        const infowindow = new google.maps.InfoWindow({
            content: lokasi,
        });

        // Open info window when marker is clicked
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });

        // Update latitude and longitude when marker is dragged
        marker.addListener('dragend', function(event) {
            const updatedLatlng = event.latLng;
            // Update your latitude and longitude input fields here if needed
            editLatitudeInput.value = updatedLatlng.lat();
            editLongitudeInput.value = updatedLatlng.lng();        
        });

        // Add click event listener to the map
        map.addListener('click', function(event) {
            // Move the marker to the clicked location
            marker.setPosition(event.latLng);

            // Update latitude and longitude input fields here if needed
            editLatitudeInput.value = event.latLng.lat();
            editLongitudeInput.value = event.latLng.lng();
        });
    }
</script>




@endsection