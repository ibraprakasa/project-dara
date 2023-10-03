<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="dara-touch-icon" sizes="120x120" href="../assets/img/daraicon.png">
  <link rel="icon" type="image/png" href="../assets/img/daraicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/bootstrap-icons-1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
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
      <nav class="navbar" style="margin-bottom:-80px">
        <div class="title">
          <a class="navbar-brand" href="javascript:;" style="visibility: hidden;margin-left:12px;margin-top:10px;border-radius:10px;text-align:center;width:350px;background-color:#3B4B65; color:white; font-weight:bold">
            Title
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
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </script>

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
    var pageTitleMap = {
      'dashboard': 'DASHBOARD',
      'stokdarah': 'STOK DARAH',
      'riwayatdonor': 'RIWAYAT',
      'jadwaldonor': 'JADWAL DONOR',
      'kelolaakun': 'KELOLA AKUN',
      'datapendonor': 'DATA PENDONOR',
      'berita': 'BERITA DONOR',
      'akun': 'AKUN',
      // Tambahkan halaman lain dan judulnya di sini
    };

    // Mendapatkan nama halaman dari path URL saat ini
    var currentPage = currentPath.split('/').pop();

    // Simpan judul asli sebelumnya
    var originalTitle = pageTitleMap[currentPage] || '';

    // Jika ada parameter pencarian, tambahkan "Hasil Pencarian: [searchParam]" ke judul
    if (searchParam) {
      // titleElement.innerHTML = originalTitle + ' - Hasil Pencarian: ' + searchParam;
      titleElement.innerHTML = originalTitle;
      $(".active").css("background-color", "#1B77A0");
    } else {
      // Jika tidak ada parameter pencarian, tampilkan judul asli
      titleElement.innerHTML = originalTitle;
      $(".active").css("background-color", "#1B77A0");

    }

    // Tampilkan judul
    titleElement.style.visibility = 'visible';
  });
</script>



</body>

</html>