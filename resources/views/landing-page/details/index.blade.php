<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    DARA Apps 
  </title>
  <link rel="shortcut icon" href="../assets/assets-landing-page/images/logo/daraicononly.png" type="image/x-icon" />
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
  @include('landing-page.navbar')
  <!-- ====== Navbar Section End -->

  <!-- ====== Hero Section Start -->
  @include('landing-page.hero')
  <!-- ====== Hero Section End -->

  <!-- ====== Features Section Start -->
  @include('landing-page.features')
  <!-- ====== Features Section End -->

  <!-- ====== About Section Start -->
  @include('landing-page.about')
  <!-- ====== About Section End -->

  <!-- ====== CTA Section Start -->
  @include('landing-page.cta')
  <!-- ====== CTA Section End -->

  <!-- ====== Pricing Section Start -->
  @include('landing-page.pricing')
  <!-- ====== Pricing Section End -->

  <!-- ====== Testimonial Section Start -->
  @include('landing-page.testimonial')
  <!-- ====== Testimonial Section End -->

  <!-- ====== FAQ Section Start -->
  @include('landing-page.faq')
  <!-- ====== FAQ Section End -->

  <!-- ====== Team Section Start -->
  @include('landing-page.team')
  <!-- ====== Team Section End -->

  <!-- ====== Blog Section Start -->
  @include('landing-page.blog')
  <!-- ====== Blog Section End -->

  <!-- ====== Contact Start ====== -->
  @include('landing-page.contact')
  <!-- ====== Contact End ====== -->

  <!-- ====== Brands Section Start -->
  @include('landing-page.brands')
  <!-- ====== Brands Section End -->

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

  <script src="../assets/assets-landing-page/js/swiper-bundle.min.js"></script>
  <script src="../assets/assets-landing-page/js/main.js"></script>
  <script>
    // ==== for menu scroll
    const pageLink = document.querySelectorAll(".ud-menu-scroll");

    pageLink.forEach((elem) => {
      elem.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(elem.getAttribute("href")).scrollIntoView({
          behavior: "smooth",
          offsetTop: 1 - 60,
        });
      });
    });

    // section menu active
    function onScroll(event) {
      const sections = document.querySelectorAll(".ud-menu-scroll");
      const scrollPos =
        window.pageYOffset ||
        document.documentElement.scrollTop ||
        document.body.scrollTop;

      for (let i = 0; i < sections.length; i++) {
        const currLink = sections[i];
        const val = currLink.getAttribute("href");
        const refElement = document.querySelector(val);
        const scrollTopMinus = scrollPos + 73;
        if (
          refElement.offsetTop <= scrollTopMinus &&
          refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
        ) {
          document
            .querySelector(".ud-menu-scroll")
            .classList.remove("active");
          currLink.classList.add("active");
        } else {
          currLink.classList.remove("active");
        }
      }
    }

    window.document.addEventListener("scroll", onScroll);

    // Testimonial
    const testimonialSwiper = new Swiper('.testimonial-carousel', {
      slidesPerView: 1,
      spaceBetween: 30,

      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        1280: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  </script>


</body>

</html>