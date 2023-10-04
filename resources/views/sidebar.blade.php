@section('sidebar')

<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo" style="margin-left:2px">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="../assets/img/daraicon.png">
            </div>
        </a>
        <a href="#" class="simple-text logo-normal" style="font-weight:bold">
            DARA
        </a>
    </div>
    <div class="sidebar-wrapper" style="background-color:#3B4B65; overflow:hidden; height:100vh">
        <ul class="nav">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" style="color: white !important; font-weight:bold;">
                    <i class="nc-icon nc-bank" style="color: white; font-weight:bold;"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            </li>
            <li class="{{ request()->routeIs('stokdarah') ? 'active' : '' }}">
                <a href="{{ route('stokdarah') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-droplet-half" style="color: white; font-weight:bold"></i>
                    <p>Stok Darah</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            <li class="{{ request()->routeIs('riwayatdonor') ? 'active' : '' }}">
                <a href="{{ route('riwayatdonor') }}" style="color: #FFFF; font-weight:bold;">
                    <i class="bi bi-hourglass-split" style="color: white; font-weight:bold;"></i>
                    <p>Riwayat</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            <li class="{{ request()->routeIs('jadwaldonor') ? 'active' : '' }}">
                <a href="{{ route('jadwaldonor') }}" style="color: white; font-weight:bold; ">
                    <i class="bi bi-calendar-event" style="color: white; font-weight:bold;"></i>
                    <p>Jadwal</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            <li class="{{ request()->routeIs('berita') ? 'active' : '' }}">
                <a href="{{ route('berita') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-newspaper" style="color: white; font-weight:bold;"></i>
                    <p>Berita</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            @if(auth()->user()->role_id == '1')
            <li class="{{ request()->routeIs('kelolaakun') ? 'active' : '' }}">
                <a href="{{ route('kelolaakun') }}" style="color: white; font-weight:bold;">
                    <i class="nc-icon nc-tile-56" style="color: white; font-weight:bold;"></i>
                    <p>Kelola Akun</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            @elseif(auth()->user()->role_id == '2')
            <li class="{{ request()->routeIs('datapendonor') ? 'active' : '' }}">
                <a href="{{ route('datapendonor') }}" style="color: white; font-weight:bold;">
                    <i class="nc-icon nc-tile-56" style="color: white; font-weight:bold;"></i>
                    <p>Data Pendonor</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            @endif
            <li class="{{ request()->routeIs('akun') ? 'active' : '' }}">
                <a href="{{ route('akun') }}" style="color: white; font-weight:bold;">
                    <i class="nc-icon nc-single-02" style="color: white; font-weight:bold;"></i>
                    <p>Akun Saya</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:-9px">
            <li>
                <a href="{{ route('logoutaksi') }}" style="color: white; font-weight:bold;">
                    <i class="bi bi-box-arrow-left whitebold" style="color: white; font-weight:bold;"></i>
                    <p>Log Out</p>
                </a>
            </li>
            <hr style="font-weight:bold; border-top:2px solid white; margin-top:2px; margin-bottom:3px">
        </ul>
        <div class="text-center" style="width:260px; margin-top:80px">
            <img src="../assets/img/logopmi.png" alt="">
        </div>
    </div>
</div>




@endsection