<section id="news" class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 bg-white">
  <div class="container mx-auto">
    <div class="flex flex-wrap justify-center -mx-4">
      <div class="w-full px-4">
        <div class="mx-auto mb-[60px] max-w-[485px] text-center">
          <span class="block mb-2 text-lg font-semibold text-primary">
            Berita Kita
          </span>
          <h2 class="mb-4 text-3xl font-bold text-dark sm:text-4xl md:text-[40px] md:leading-[1.2]">
            Terbaru & Terkini
          </h2>
          <p class="text-base text-body-color">
            Berita terkini donor darah di Padang: info donatur, kegiatan komunitas, dan perkembangan kesehatan masyarakat.
          </p>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap -mx-4">
      @foreach($news3 as $row)
      <div class="w-full px-4 md:w-1/2 lg:w-1/3">
        <div class="wow fadeInUp group mb-10" data-wow-delay=".1s">
          <div class="mb-8 overflow-hidden rounded-[5px]">
            <a href="{{ route('news-detail', ['id' => $row->id]) }}" class="block">
              <img src="{{ asset('assets/img/' .$row->gambar) }}" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125" />
            </a>
          </div>
          <div>
            <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">
              {{ $row->created_at->setTimezone('Asia/Jakarta')->translatedFormat('j F Y') }}
            </span>
            <h3>
              <a align="justify" href="{{ route('news-detail', ['id' => $row->id]) }}" class="inline-block mb-4 text-xl font-semibold text-dark hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">
                {{ $row->judul }}
              </a>
            </h3>
            <p align="justify" class="max-w-[370px] text-base text-body-color">
              {{ \Illuminate\Support\Str::limit(strip_tags($row->deskripsi), 150) }}
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-right wow fadeInUp" data-wow-delay=".2s" style="display: flex;justify-content: flex-end;">
      <a href="{{ route('news-list') }}" class="inline-flex items-center justify-center py-3 text-base font-medium text-center text-white border border-primary rounded-md px-7 bg-primary hover:bg-blue-dark hover:border-blue-dark">
        Lihat Semua Berita
      </a>
    </div>
  </div>
</section>