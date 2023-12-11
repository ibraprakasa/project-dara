@extends('template')
@extends('sidebar')
@section('judul_halaman', 'Dashboard')
@section('content')

<div class="content">

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
            Dalam bulan ini
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
            Baru saja
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
                <p class="card-title">{{ $thisYearBerita }}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-clock-o"></i>
            Dalam 1 tahun terakhir
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card ">
        <div class="card-body ">
          <div id="chartContainer"></div>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="fa fa-history"></i> Baru saja
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card ">
        <div class="card-body ">
          <div id="chartGoldar"></div>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="fa fa-history"></i> Baru saja
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  var options = {
    series: [{
      name: "Jumlah Acara Donor",
      data: 
      <?php
      echo json_encode($jumlahAcaraDonor)
      ?>
    }],
    chart: {
      height: 350,
      type: 'bar',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth'
    },
    title: {
      text: 'Jadwal Donor Terlaksana',
      align: 'left'
    },
    subtitle: {
      text: 'Dalam 1 tahun',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      },
    },
    xaxis: {
      categories: 
      <?php 
      echo json_encode($bulan)
      ?>
    }
  };

  var chart = new ApexCharts(document.querySelector("#chartContainer"), options);
  chart.render();
</script>

<script>
  var options = {
    series: <?php echo json_encode($grafikSeries); ?>,
    chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      width: [2, 2, 2, 2],
      curve: 'straight',
      dashArray: [0, 0, 0, 0]
    },
    title: {
      text: 'Stok Darah Masuk',
      align: 'left'
    },
    subtitle: {
      text: 'Dalam 1 tahun',
      align: 'left'
    },
    legend: {
      tooltipHoverFormatter: function(val, opts) {
        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
      }
    },
    markers: {
      size: 0,
      hover: {
        sizeOffset: 6
      }
    },
    xaxis: {
      categories:
      <?php 
      echo json_encode($bulan)
      ?>
    },
    tooltip: {
      y: [{
          title: {
            formatter: function(val) {
              return val;
            }
          }
        },
        {
          title: {
            formatter: function(val) {
              return val;
            }
          }
        },
        {
          title: {
            formatter: function(val) {
              return val;
            }
          }
        }
      ]
    },
    grid: {
      borderColor: '#f1f1f1',
    }
  };

  var chart = new ApexCharts(document.querySelector("#chartGoldar"), options);
  chart.render();
</script>
@endsection

@section('footer')
<footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="{{ route('landing-page') }}#news" target="_blank">BERITA</a></li>
                <li><a href="{{ route('landing-page') }}#contact" target="_blank">KONTAK</a></li>
                <li><a href="{{ route('landing-page') }}" target="_blank">LANDING PAGE</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by DARA Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
@endsection