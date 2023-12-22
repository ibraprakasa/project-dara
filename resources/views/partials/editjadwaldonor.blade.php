@extends('template')
@section('judul_halaman', 'Jadwal Donor')
@section('content')


<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('jadwaldonor') }}">Jadwal</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Edit Jadwal</a></li>
        </ol>
    </nav>
</div>

<div class="container mt-3 ml-3">
    <form action="{{ route('updatejadwaldonor', ['id' => $jadwalDonor->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="namalokasi">Nama Lokasi</label>
                    <input class="kolom form-control" type="text" name="lokasi" id="namalokasi" value="{{ $jadwalDonor->lokasi }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="kontak">Kontak</label>
                    <input class="kolom form-control" name="kontak" type="number" id="kontak" value="{{ $jadwalDonor->kontak }}">
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="form-group" style="color:black; font-weight:bold">
                    <label for="tanggal">Tanggal</label>
                    <input class="kolom form-control" name="tanggal_donor" type="date" id="tanggal" value="{{ $jadwalDonor->tanggal_donor }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="jammulai">Jam Mulai</label>
                            <input class="kolom form-control" name="jam_mulai" type="time" id="jammulai" value="{{ $jadwalDonor->jam_mulai }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="jamselesai">Jam Selesai</label>
                            <input class="kolom form-control" name="jam_selesai" type="time" id="jamselesai" value="{{ $jadwalDonor->jam_selesai }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 col mt-3">
                <div id="mapEdit{{ $jadwalDonor->id }}" style="height: 330px;"></div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col">
                        <div class="form-group" style="color:black; font-weight:bold">
                            <label for="alamat">Alamat</label>
                            <textarea class="kolom form-control alamat" name="alamat" id="alamat" rows="3">{{ $jadwalDonor->alamat }}</textarea>
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
        <hr>
        <div style="display: flex;justify-content: flex-end;">
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