@foreach($show as $berita)
<section class="pt-20 pb-10 lg:pt-[120px] lg:pb-20 bg-white">
    <div class="container mx-auto">
        <!-- Konten Halaman Detail Berita -->
        <div class="mx-auto max-w-[800px] text-center">
        
            <h2 class="mb-4 text-3xl font-bold text-dark sm:text-4xl md:text-[40px] md:leading-[1.2]">
                {{ $berita->judul }}
            </h2>
            <p class="text-base text-body-color">
                {{ $berita->created_at->setTimezone('Asia/Jakarta')->translatedFormat('j F Y') }}
            </p>
        </div>
        <div class="max-w-[800px] mx-auto mt-8">
            <img src="{{ asset('assets/img/' . $berita->gambar) }}" alt="image" class="w-full mb-6" />
            <p class="text-base text-body-color">
                {{ $berita->deskripsi }}
            </p>
        </div>
    </div>
</section>
@endforeach
