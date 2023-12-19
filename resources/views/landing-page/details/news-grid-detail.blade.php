<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Daftar Berita
  </title>
  <link rel="shortcut icon" href="../assets/img/daraicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="../assets/assets-landing-page/css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../assets/assets-landing-page/css/animate.css" />
  <link rel="stylesheet" href="../assets/assets-landing-page/css/tailwind.css" />

  <!-- ==== WOW JS ==== -->
  <script src="../assets/assets-landing-page/js/wow.min.js"></script>
  <script>
    new WOW().init();
  </script>
</head>

<body>
  <!-- ====== Navbar Section Start -->
  @include('landing-page.navbar-detail')

  <!-- ====== Navbar Section End -->

  <!-- ====== Banner Section Start -->
  @include('landing-page.banner')
  <!-- ====== Banner Section End -->

  <!-- ====== News Section Start -->
  <section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20">
    <div class="container">
      <div class="-mx-4 flex flex-wrap">
        @foreach($news as $row)
        <div class="w-full px-4 md:w-1/2 lg:w-1/3">
          <div class="wow fadeInUp group mb-10" data-wow-delay=".1s">
            <div class="mb-8 overflow-hidden rounded-[5px]">
              <a href="{{ route('news-detail', ['id' => $row->id]) }}" class="block">
                <img src="{{ asset('assets/img/' .$row->gambar) }}" alt="image"
                  class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
              </a>
            </div>
            <div>
              <span
                class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">
                {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('j F Y') }}
              </span>
              <h3>
                <a href="blog-details.html"
                  class="inline-block mb-4 text-xl font-semibold text-dark hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">
                  {{ $row->judul }}
                </a>
              </h3>
              <p class="max-w-[370px] text-base text-body-color">
              {{ \Illuminate\Support\Str::limit(strip_tags($row->deskripsi), 150) }}
              </p>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="text-center wow fadeInUp" data-wow-delay=".2s">
        {{ $news->links() }}
      </div>
    </div>
  </section>
  <!-- ====== Blog Section End -->

  <!-- ====== Footer Section Start -->
  @include('landing-page.footer')
  <!-- ====== Footer Section End -->

  <!-- ====== Back To Top Start -->
  <a href="javascript:void(0)"
    class="back-to-top fixed bottom-8 right-8 left-auto z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
    <span class="mt-[6px] h-3 w-3 rotate-45 border-t border-l border-white"></span>
  </a>
  <!-- ====== Back To Top End -->

  <!-- ====== All Scripts -->
  <script src="../assets/assets-landing-page/js/main.js"></script>
</body>

</html>