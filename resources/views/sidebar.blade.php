@section('sidebar')

<link href="../assets/css/stylepartials.css" rel="stylesheet">


<div class="sidebar" data-color="white" data-active-color="danger">
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
    <div class="sidebar-wrapper" style="background-color:#3B4B65; overflow:hidden; height:100vh">
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
            <li class="{{ request()->routeIs('jadwaldonor', 'infopendaftar') ? 'active' : '' }}">
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
            <li class="{{ request()->routeIs('forum') ? 'active' : '' }}">
                <a href="{{ route('forum') }}" style="color: white; font-weight:bold;">
                    <i class="fa fa-comments" style="color: white; font-weight:bold;"></i>
                    <p>Forum</p>
                </a>
            </li>
            <hr class="jaraksidebar">
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
        </ul>
        <div class="text-center gambar">
            <img src="../assets/img/logopmi.png" alt="">
        </div>
    </div>
</div>

<!-- MODAL KELUAR AKUN -->
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
                    <button type="button" class="btn btn-dark" style="background-color: black; border-radius:10px" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #E70000; border-radius:10px">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END MODAL -->

@endsection