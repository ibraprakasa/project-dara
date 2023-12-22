<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="dara-touch-icon" sizes="120x120" href="../assets/img/daraicon.png">
  <link rel="icon" type="image/x-icon" href="../assets/img/daraiconico.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/bootstrap-icons-1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link href="../assets/css/stylepartials.css" rel="stylesheet">
  <!-- <link href="../assets/css/stylesidebar.css" rel="stylesheet"> -->

  <title>
    DARA || @yield('judul_halaman', 'Judul Default')
  </title>


</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    @include('sidebar')
    <!-- End Sidebar -->
    <div class="main-panel" style="background-color:white">
      <!-- Navbar -->
      <!-- <nav class="nav-title" style="margin-bottom:-80px">
          <div class="title">
            <a class="navbar-brand" href="javascript:;" style="visibility: hidden;margin-left:12px;margin-top:10px;border-radius:10px;text-align:center;width:350px;background-color:#3B4B65; color:white; font-weight:bold">
              <span id="pageTitle">Title</span>
            </a>
          </div>

      </nav> -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid container-style">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler" onclick="toggleSidebar()">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand navbar-style" href="javascript:;">
              <span id="pageTitle">Title</span>
            </a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @hasSection('breadcrumb')
                    <li class="breadcrumb-item">@yield('breadcrumb')</li>
                    @endif
                  </ol>
                </nav>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- Content -->
      @yield('content')
      <!-- EndContent -->
      @yield('footer')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <!-- <script src="../assets/js/sidebar.js"></script> -->


  <script>
    $(document).ready(function() {
      // Mendapatkan path URL saat ini
      var currentPath = window.location.pathname;

      var titleElement = document.querySelector('.navbar-brand');

      // Loop melalui setiap tautan sidebar
      $(".sidebar a").each(function() {
        // Memeriksa apakah tautan saat ini sesuai dengan path URL saat ini
        if ($(this).attr("href") === currentPath) {
          // Mengubah warna latar belakang sidebar
          $(".active").css("background-color", "#1B77A0");
<<<<<<< HEAD
          return false; // Berhenti dari loop jika tautan cocok
=======
          return false;
>>>>>>> 0823241284f7f0ef799627da4234a70180fc15c2
        }
      });

      // Mendapatkan parameter query 'search' dari URL
      var searchParam = new URLSearchParams(window.location.search).get('search');
      var idParam = new URLSearchParams(window.location.search).get('id'); // Mendapatkan parameter 'id' dari URL

      var pageTitleMap = {
        'dashboard': 'DASHBOARD',
        'stokdarah': 'STOK DARAH',
        'riwayatdonor': 'RIWAYAT',
        'jadwaldonor': 'JADWAL DONOR',
        'kelolaakun': 'KELOLA AKUN',
        'datapendonor': 'DATA PENDONOR',
        'berita': 'BERITA DONOR',
        'akun': 'AKUN',
        'infopendaftar': 'INFO PENDAFTAR',
        'forum-postingan': 'FORUM DONOR',
        'laporan': 'LAPORAN',
        'feedback': 'TANGGAPAN'

      };

      var currentPage = currentPath.split('/').pop();

      var originalTitle = pageTitleMap[currentPage] || '';

      if (idParam) {
<<<<<<< HEAD
        titleElement.innerHTML = 'INFORMASI DETAIL';
=======
        if (currentPage === 'infopendaftar') {
          titleElement.innerHTML = 'INFO PENDAFTAR';
        } else if (currentPage === 'editjadwaldonor') {
          titleElement.innerHTML = 'EDIT JADWAL DONOR';
        } else {
          titleElement.innerHTML = 'INFORMASI DETAIL';
        }
>>>>>>> 0823241284f7f0ef799627da4234a70180fc15c2
        $(".active").css("background-color", "#1B77A0");
      } else if (searchParam) {
        titleElement.innerHTML = originalTitle;
        $(".active").css("background-color", "#1B77A0");
      } else {
        titleElement.innerHTML = originalTitle;
        $(".active").css("background-color", "#1B77A0");
      }

      titleElement.style.visibility = 'visible';
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var komentarLink = document.getElementById("komentarLink");
      if (komentarLink) {
        komentarLink.addEventListener("click", function(event) {
          event.preventDefault();
          window.history.back();
        });
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      $("[data-fancybox]").fancybox();
    });
  </script>

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
            <button type="button" class="btn btn-dark modalbuttonclose-style" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger modalbuttondanger-style">Keluar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END MODAL -->

</body>

</html>