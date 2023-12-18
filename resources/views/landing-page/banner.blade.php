<div class="relative z-10 overflow-hidden pt-[120px] pb-[60px] md:pt-[130px] lg:pt-[160px] bg-primary">
    <div class="w-full h-px bg-gradient-to-r from-stroke/0 via-stroke to-stroke/0 absolute left-0 bottom-0">
    </div>
    <div class="container">
      <div class="-mx-4 flex flex-wrap items-center">
        <div class="w-full px-4">
          <div class="text-center">
            <h1 class="mb-4 text-3xl font-bold text-white sm:text-4xl md:text-[40px] md:leading-[1.2]">Berita</h1>
            <p class="mb-5 text-base text-white">
            Ada beragam informasi yang dapat ditemukan untuk mendapatkan gambaran lebih lanjut.            
            </p>
            <ul class="flex items-center justify-center gap-[10px]">
              <li>
                <a href="{{ route('landing-page') }}" class="flex items-center gap-[10px] text-base font-medium text-white hover:text-primary">
                  Beranda
                </a>
              </li>
              <li>
                <a href="javascript:void(0)"  onclick="refreshPage()" class="flex items-center gap-[10px] text-base font-medium text-white hover:text-primary">
                  <span class="text-black"> / </span>
                  Detail
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div>
      <span class="absolute top-0 left-0">
        <svg width="100" height="600" viewBox="0 0 495 470" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="55" cy="442" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
          <circle cx="446" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
          <path d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z" stroke="white"
            stroke-opacity="0.08" stroke-width="12" />
        </svg>
      </span>
      <span class="absolute bottom-0 right-0">
        <svg width="100" height="600" viewBox="0 0 493 470" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="462" cy="5" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
          <circle cx="49" cy="470" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
          <path d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z" stroke="white"
            stroke-opacity="0.06" stroke-width="13" />
        </svg>
      </span>
    </div>
  </div>