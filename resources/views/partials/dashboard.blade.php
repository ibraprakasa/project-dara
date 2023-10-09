@extends('template')
@extends('sidebar')
@section('content')

<head>
  <title>
    DARA || Dashboard
  </title>
  <link href="../assets/css/stylepartials.css" rel="stylesheet">
</head>



<div class="content" style="background-color:white">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-danger">
                      <i class="bi bi-droplet-half text-danger sizeicon"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Stok</p>
                      <p class="card-title">{{ $totalStokDarah }}<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                <i class="fa fa-archive"></i>
                  Tersedia
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
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
                      <p class="card-title small-text">{{ $thisMonthJadwal }} Kegiatan<p>
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
          <div class="col-lg-3 col-md-6 col-sm-6">
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
                      <p class="card-title small-text">{{ $totalBerita }} Artikel<p>
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
          <div class="col-lg-3 col-md-6 col-sm-6">
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
                      <p class="card-title small-text">{{ $totalPendonor }} Orang<p>
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
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Users Behavior</h5>
              <p class="card-category">24 Hours performance</p>
            </div>
            <div class="card-body ">
              <canvas id=chartHours width="400" height="100"></canvas>
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
      <div class="row">
        <div class="col-md-4">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Email Statistics</h5>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-body ">
              <canvas id="chartEmail"></canvas>
            </div>
            <div class="card-footer ">
              <div class="legend">
                <i class="fa fa-circle text-primary"></i> Opened
                <i class="fa fa-circle text-warning"></i> Read
                <i class="fa fa-circle text-danger"></i> Deleted
                <i class="fa fa-circle text-gray"></i> Unopened
              </div>
              <hr>
              <div class="stats">
                <i class="fa fa-calendar"></i> Number of emails sent
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card card-chart">
            <div class="card-header">
              <h5 class="card-title">NASDAQ: AAPL</h5>
              <p class="card-category">Line Chart with Points</p>
            </div>
            <div class="card-body">
              <canvas id="speedChart" width="400" height="100"></canvas>
            </div>
            <div class="card-footer">
              <div class="chart-legend">
                <i class="fa fa-circle text-info"></i> Tesla Model S
                <i class="fa fa-circle text-warning"></i> BMW 5 Series
              </div>
              <hr />
              <div class="card-stats">
                <i class="fa fa-check"></i> Data information certified
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer footer-black  footer-white ">
      <div class="container-fluid">
        <div class="row">
          <nav class="footer-nav">
            <ul>
              <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
              <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
              <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
            </ul>
          </nav>
          <div class="credits ml-auto">
            <span class="copyright">
              © <script>
                document.write(new Date().getFullYear())
              </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
            </span>
          </div>
        </div>
      </div>
    </footer>
@endsection