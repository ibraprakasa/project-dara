@extends('template')
@extends('sidebar')
@section('content')

<head>
  <title>
    DARA || Dashboard
  </title>
  <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.43.0/apexcharts.min.css" integrity="sha512-nnNXPeQKvNOEUd+TrFbofWwHT0ezcZiFU5E/Lv2+JlZCQwQ/ACM33FxPoQ6ZEFNnERrTho8lF0MCEH9DBZ/wWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.43.0/apexcharts.min.js" integrity="sha512-vv0F8Er+ByFK3l86WDjP5Zc0h8uxNWPzF+l4wGK0/BlHWxDiFHbYr/91dn8G0OO8tTnN40L4s2Whom+X2NxPog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  var options = {
    series: [{
      name: "Desktops",
      data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
    }],
    chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight'
    },
    title: {
      text: 'Product Trends by Month',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    }
  };

  var chart = new ApexCharts(document.querySelector("#chartContainer"), options);
  chart.render();
</script>
<div class="content" style="background-color:white">

  <div class="row">
    @foreach ($golonganDarahCounts as $golonganDarahCount)
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-danger" style="color: #EB1F3E;">
                <i class="bi bi-droplet-half sizeicon"></i>
              </div>
            </div>
            <div class="col-7 col-md-7">
              <div class="numbers">
                <p class="card-category">Gol. Darah {{ $golonganDarahCount->nama }}</p>
                <p class="card-title">{{ $golonganDarahCount->total_jumlah }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <hr>
          <div class="stats">
            <i class="fa fa-medkit"></i>
            Stok Darah Tipe {{ $golonganDarahCount->nama }}
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 mx-auto">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="bi bi-calendar-event-fill text-success sizeicon"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Jadwal</p>
                <p class="card-title">{{ $thisMonthJadwal }}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-calendar-o"></i>
            Dalam 1 bulan kedepan
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mx-auto">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-primary">
                <i class="bi bi-people-fill text-primary sizeicon"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Pendonor</p>
                <p class="card-title small-text">{{ $totalPendonor }}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-refresh"></i>
            Terbaru
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mx-auto">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="bi bi-newspaper text-warning sizeicon"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Berita</p>
                <p class="card-title">{{ $totalBerita }}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-clock-o"></i>
            Dalam 1 minggu terakhir
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Stok Darah Tersedia</h5>
          <p class="card-category">Dalam Waktu 1 Tahun</p>
        </div>
        <div class="card-body ">
          <div id="chartContainer"></div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-history"></i> Updated 3 minutes ago
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection