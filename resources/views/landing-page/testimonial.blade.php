<section id="testimonials" class="py-20 md:py-[120px] bg-gray-1 overflow-hidden">
  <div class="container mx-auto">
    <div class="flex flex-wrap justify-center -mx-4">
      <div class="w-full px-4">
        <div class="mx-auto mb-[60px] max-w-[485px] text-center">
          <span class="block mb-2 text-lg font-semibold text-primary">
            Testimoni
          </span>
          <h2 class="text-dark mb-3 text-3xl leading-[1.2] font-bold sm:text-1xl md:text-[20px]">
            Membangun Harapan Bersama
          </h2>
          <p class="text-base text-body-color">
            Saksikan ikatan emosional cerita pengguna, soroti peran DARA dalam komunitas dukungan dan penuh harapan.
        </div>
      </div>
    </div>

    <div class="-m-5">
      <div class="swiper testimonial-carousel common-carousel p-5">
        <div class="swiper-wrapper">
          @foreach($testi as $row)
          @if($row->status)
          <div class="swiper-slide">
            <div class="shadow-testimonial bg-white rounded-xl py-[30px] px-4 sm:px-[30px]">
              <div class="flex items-center gap-[2px] mb-[18px]">
                @if($row->star==5)
                @for ($i = 0; $i
                < 5;$i++) <img src="{{ asset('assets/assets-landing-page/images/testimonials/icon-star.svg') }}" alt="star icon" />
                @endfor
                @elseif($row->star==4)
                @for ($i = 0; $i
                < 4;$i++) <img src="{{ asset('assets/assets-landing-page/images/testimonials/icon-star.svg') }}" alt="star icon" />
                @endfor
                @elseif($row->star==3)
                @for ($i = 0; $i
                < 3;$i++) <img src="{{ asset('assets/assets-landing-page/images/testimonials/icon-star.svg') }}" alt="star icon" />
                @endfor
                @elseif($row->star==2)
                @for ($i = 0; $i
                < 2;$i++) <img src="{{ asset('assets/assets-landing-page/images/testimonials/icon-star.svg') }}" alt="star icon" />
                @endfor
                @elseif($row->star==1)
                <img src="{{ asset('assets/assets-landing-page/images/testimonials/icon-star.svg') }}" alt="star icon" />
                @endif
              </div>

              <p class="text-body-color text-base mb-6">
                {{ $row->text }} 
              </p>

              <a class="flex items-center gap-4">
                <div class="w-[50px] h-[50px] rounded-full overflow-hidden">
                  <img src="{{ asset('assets/img/' . $row->pendonor->gambar) }}" alt="author" class="w-[50px] h-[50px] rounded-full overflow-hidden" />
                </div>

                <div>
                  <h3 class="font-semibold text-sm text-dark">
                    {{ $row->pendonor->nama }}
                  </h3>
                  <p class="text-xs text-body-secondary">{{ $row->pendonor->kode_pendonor }}</p>
                </div>
              </a>
            </div>
          </div>
          @endif
          @endforeach
        </div>


        <div class="flex items-center justify-center mt-[60px] gap-1">
          <div class="swiper-button-prev">
            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.25 10.2437H4.57187L10.4156 4.29687C10.725 3.9875 10.725 3.50625 10.4156 3.19687C10.1062 2.8875 9.625 2.8875 9.31562 3.19687L2.2 10.4156C1.89062 10.725 1.89062 11.2063 2.2 11.5156L9.31562 18.7344C9.45312 18.8719 9.65937 18.975 9.86562 18.975C10.0719 18.975 10.2437 18.9062 10.4156 18.7687C10.725 18.4594 10.725 17.9781 10.4156 17.6688L4.60625 11.7906H19.25C19.6625 11.7906 20.0063 11.4469 20.0063 11.0344C20.0063 10.5875 19.6625 10.2437 19.25 10.2437Z" />
            </svg>
          </div>

          <div class="swiper-button-next">
            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.8 10.45L12.6844 3.2313C12.375 2.92192 11.8938 2.92192 11.5844 3.2313C11.275 3.54067 11.275 4.02192 11.5844 4.3313L17.3594 10.2094H2.75C2.3375 10.2094 1.99375 10.5532 1.99375 10.9657C1.99375 11.3782 2.3375 11.7563 2.75 11.7563H17.4281L11.5844 17.7032C11.275 18.0126 11.275 18.4938 11.5844 18.8032C11.7219 18.9407 11.9281 19.0094 12.1344 19.0094C12.3406 19.0094 12.5469 18.9407 12.6844 18.7688L19.8 11.55C20.1094 11.2407 20.1094 10.7594 19.8 10.45Z" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>