<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="dara-touch-icon" sizes="120x120" href="../assets/img/daraicon.png">
  <link rel="icon" type="image/png" href="../assets/img/daraicon.png">
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
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    @yield('sidebar')
    <!-- End Sidebar -->
    <div class="main-panel" style="background-color:white">
      <!-- Navbar -->
      <nav class="nav-title" style="margin-bottom:-80px">
        <div class="title">
          <a class="navbar-brand" href="javascript:;" style="visibility: hidden;margin-left:12px;margin-top:10px;border-radius:10px;text-align:center;width:350px;background-color:#3B4B65; color:white; font-weight:bold">
            <span id="pageTitle">Title</span>
          </a>
        </div>

      </nav>
      <!-- End Navbar -->
      <!-- Content -->
      @yield('content')
      <!-- EndContent -->

    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>  
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

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
          return false; // Berhenti dari loop jika tautan cocok
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
        titleElement.innerHTML = 'FORUM DONOR';
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
    document.getElementById("komentarLink").addEventListener("click", function(event) {
      event.preventDefault();
      window.history.back();
    });
  </script>

  <script>
      $(document).ready(function() {
          $("[data-fancybox]").fancybox();
      });
  </script>


</body>

</html>