@extends('layouts.app')
@section('title', 'Firma Hukum Terpercaya di Balikpapan | ASDM Associates')
@section('meta_description', 'ASDM Associates adalah firma hukum profesional di Balikpapan yang menangani perkara perdata, pidana, dan hukum korporasi dengan pengalaman lebih dari 10 tahun. Konsultasi gratis!')
@section('canonical', route('home'))
@section('meta_image', asset('images/home-og-image.jpg'))

@section('content')
<section class="relative isolate min-h-[640px] overflow-hidden">
  <img src="{{ asset('images/section1.jpeg') }}" alt="ASDM Associates" class="absolute inset-0 h-full w-full object-cover" loading="lazy">
  <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/55 to-transparent"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(139,92,246,0.15),transparent_50%)]"></div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-28 pb-24 sm:pt-36 sm:pb-32 lg:pt-44 lg:pb-40">
    <!-- Main Content Wrapper -->
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8 lg:gap-12">

      <!-- Left Section: Logo and Text -->
      <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-6 w-full lg:w-auto">
        <div class="text-white animate-[fadeInUp_0.8s_ease]">
          <p class="text-base sm:text-lg lg:text-xl font-semibold tracking-wide">ASDM Associates</p>
          <h1 class="mt-1 sm:mt-2 text-2xl sm:text-3xl lg:text-5xl font-bold leading-tight">
            Firma Hukum Profesional<br class="hidden sm:block"> Balikpapan
          </h1>
          <p class="mt-2 sm:mt-3 lg:mt-4 max-w-2xl text-xs sm:text-sm lg:text-base text-white/90 leading-relaxed">
            Pendampingan hukum yang tegas, terukur, dan berorientasi solusi bagi individu maupun korporasi.
          </p>
          <br>
           <div class="flex flex-row sm:flex-row gap-3 sm:gap-4 w-full lg:w-auto animate-[fadeInUp_1s_ease]">
        <a href="{{ route('member') }}" class="group rounded-xl lg:rounded-2xl bg-black/80 backdrop-blur-sm px-4 py-4 sm:px-5 sm:py-5 lg:px-6 lg:py-5 flex-1 sm:flex-none sm:min-w-[160px] lg:min-w-[170px] text-white shadow-xl hover:bg-black/90 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl border border-white/10 hover:border-white/20">
          <p class="text-xs sm:text-sm font-semibold text-white/70 group-hover:text-white/90 transition-colors">Anggota & Partner Aktif</p>
          <p class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold leading-none group-hover:scale-110 transition-transform duration-300">5</p>
        </a>

        <a href="{{ route('portfolio') }}" class="group rounded-xl lg:rounded-2xl bg-black/80 backdrop-blur-sm px-4 py-4 sm:px-5 sm:py-5 lg:px-6 lg:py-5 flex-1 sm:flex-none sm:min-w-[160px] lg:min-w-[170px] text-white shadow-xl hover:bg-black/90 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl border border-white/10 hover:border-white/20">
          <p class="text-xs sm:text-sm font-semibold text-white/70 group-hover:text-white/90 transition-colors">Jumlah Kasus</p>
          <p class="mt-2 sm:mt-3 text-2xl sm:text-3xl font-bold leading-none group-hover:scale-110 transition-transform duration-300">300+</p>
        </a>
      </div>
      <br>

          <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 rounded-full bg-white text-emerald-950 px-5 py-2.5 text-sm font-semibold shadow-lg transition hover:-translate-y-0.5 hover:shadow-xl">
              Konsultasi Sekarang
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Right Section: Stats Cards -->

    </div>
  </div>
</section>


{{-- =========================
   SECTION 1: MITRA (Logo Slider) - from DB/Filament
========================= --}}
<section class="relative py-14 sm:py-16 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex items-end justify-between gap-6">
      <div class="mx-auto text-center max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">
          Partner
        </p>

        <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-emerald-950">
          Dipercaya oleh berbagai pihak
        </h2>
      </div>
    </div>

    @if(isset($partners) && $partners->count())
      <div class="mt-8 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white/70 backdrop-blur">
        <div class="relative py-6">
          <div class="pointer-events-none absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-white/70 to-transparent z-10"></div>
          <div class="pointer-events-none absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-white/70 to-transparent z-10"></div>

            <div class="logo-slider-wrapper relative">
              <div class="logo-track flex items-center gap-10">
                {{-- Set 1 --}}
                @foreach($partners as $partner)
                  <div class="flex items-center justify-center flex-shrink-0 logo-item">
                    <img
                      src="{{ asset('storage/' . $partner->logo) }}"
                      alt="{{ $partner->name ?? 'Logo Mitra' }}"
                      class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                      loading="lazy"
                    >
                  </div>
                @endforeach

                {{-- Set 2 (duplicate for seamless loop) --}}
                @foreach($partners as $partner)
                  <div class="flex items-center justify-center flex-shrink-0 logo-item">
                    <img
                      src="{{ asset('storage/' . $partner->logo) }}"
                      alt="{{ $partner->name ?? 'Logo Mitra' }}"
                      class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                      loading="lazy"
                    >
                  </div>
                @endforeach
                {{-- Set 3 (duplicate for lebih mulus) --}}
                @foreach($partners as $partner)
                  <div class="flex items-center justify-center flex-shrink-0 logo-item">
                    <img
                      src="{{ asset('storage/' . $partner->logo) }}"
                      alt="{{ $partner->name ?? 'Logo Mitra' }}"
                      class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                      loading="lazy"
                    >
                  </div>
                @endforeach
                {{-- Set 4 (duplicate for lebih mulus) --}}
                @foreach($partners as $partner)
                  <div class="flex items-center justify-center flex-shrink-0 logo-item">
                    <img
                      src="{{ asset('storage/' . $partner->logo) }}"
                      alt="{{ $partner->name ?? 'Logo Mitra' }}"
                      class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                      loading="lazy"
                    >
                  </div>
                @endforeach
              </div>
            </div>
          </div>
      </div>
    @else
      <div class="mt-8 rounded-3xl border border-emerald-900/10 bg-white p-8 text-slate-600">
        Logo partner belum tersedia.
      </div>
    @endif
  </div>
</section>

{{-- =========================
   SECTION 1B: KLIEN (Logo Slider) - arah berlawanan
========================= --}}
@if(isset($clients) && $clients->count())
<section class="relative py-10 sm:py-12 bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mx-auto text-center max-w-3xl">
      <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">
        Klien
      </p>
      <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-emerald-950">
        Klien yang mempercayai kami
      </h2>
    </div>

    <div class="mt-8 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white/70 backdrop-blur">
      <div class="relative py-6">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-white/70 to-transparent z-10"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-white/70 to-transparent z-10"></div>

        <div class="logo-slider-wrapper relative">
          <div class="logo-track-reverse flex items-center gap-10">
            @foreach($clients as $client)
              <div class="flex items-center justify-center flex-shrink-0 logo-item">
                <img
                  src="{{ asset('storage/' . $client->logo) }}"
                  alt="{{ $client->name ?? 'Logo Klien' }}"
                  class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                  loading="lazy"
                >
              </div>
            @endforeach
            @foreach($clients as $client)
              <div class="flex items-center justify-center flex-shrink-0 logo-item">
                <img
                  src="{{ asset('storage/' . $client->logo) }}"
                  alt="{{ $client->name ?? 'Logo Klien' }}"
                  class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                  loading="lazy"
                >
              </div>
            @endforeach
            @foreach($clients as $client)
              <div class="flex items-center justify-center flex-shrink-0 logo-item">
                <img
                  src="{{ asset('storage/' . $client->logo) }}"
                  alt="{{ $client->name ?? 'Logo Klien' }}"
                  class="h-12 w-auto max-h-14 object-contain opacity-100 transition hover:scale-[1.03]"
                  loading="lazy"
                >
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif


{{-- =========================
   SECTION 2: GALERI (Preview) - from DB/Filament
========================= --}}
<section class="relative py-14 sm:py-16"
  x-data="{
    open: false,
    title: '',
    slides: [],
    index: 0,
    show(images, title){
      this.slides = images;
      this.title = title;
      this.index = 0;
      this.open = true;
      document.body.classList.add('overflow-hidden');
    },
    close(){
      this.open = false;
      document.body.classList.remove('overflow-hidden');
    },
    next(){ if(this.slides.length){ this.index = (this.index + 1) % this.slides.length; } },
    prev(){ if(this.slides.length){ this.index = (this.index - 1 + this.slides.length) % this.slides.length; } }
  }"
>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 items-end gap-4">

  {{-- KIRI (kosong, hanya spacer) --}}
  <div class="hidden sm:block"></div>

  {{-- TENGAH (judul benar-benar center) --}}
  <div class="text-center max-w-3xl mx-auto">
    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">
      Galeri
    </p>

    <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-emerald-950">
      Dokumentasi kegiatan & momen
    </h2>
  </div>

  {{-- KANAN (CTA tetap di kanan) --}}
  <div class="flex justify-center sm:justify-end">
    <a
      href="{{ route('gallery') }}"
      class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-900 hover:text-emerald-950 transition"
    >
      Lihat semua galeri
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
          d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
      </svg>
    </a>
  </div>

</div>


    @if(isset($galleries) && $galleries->count())
  @php
    $galleryItems = $galleries;
    $galleryCount = $galleryItems->count();
  @endphp

  <div
    class="mt-8 space-y-4"
    x-data="{
      current: 0,
      perView: 4,
      total: {{ $galleryCount }},
      next(){ if(this.total <= this.perView) return; this.current = (this.current + this.perView) % this.total; },
      prev(){ if(this.total <= this.perView) return; this.current = (this.current - this.perView + this.total) % this.total; },
      translate(){
        if (this.total === 0) return '';
        const shift = this.current * (100 / this.perView);
        return `transform: translateX(-${shift}%); transition: transform 0.45s ease;`;
      }
    }"
  >
    <div class="overflow-hidden rounded-3xl border border-emerald-900/10 bg-white/80 ring-1 ring-emerald-900/5">
      <div class="flex gap-4 px-4 py-6 sm:px-6" :style="translate()">
        @foreach($galleryItems as $item)
          @php
            $images = collect($item->images ?? [])
              ->filter()
              ->map(fn($img) => asset('storage/' . $img))
              ->values();
            if ($images->isEmpty() && $item->image) {
              $images->push(asset('storage/' . $item->image));
            }
            $thumb = $images->first();
          @endphp
          <div class="group w-full flex-shrink-0" style="width: calc(100% / 4);">
            <button
              type="button"
              class="relative block w-full overflow-hidden rounded-2xl bg-white ring-1 ring-emerald-900/10 shadow-sm transition hover:-translate-y-1 hover:shadow-xl text-left"
              @click='show(@json($images), @json($item->title ?? "Dokumentasi"))'
            >
              @if($thumb)
                <img
                  src="{{ $thumb }}"
                  alt="{{ $item->title ?? 'Dokumentasi' }}"
                  class="h-40 w-full object-cover transition duration-500 group-hover:scale-105"
                  loading="lazy"
                >
              @endif

              <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>

              <div class="absolute bottom-3 left-3 right-3 flex justify-end opacity-0 transition group-hover:opacity-100">
                <span class="rounded-full bg-white/20 px-2 py-1 text-[11px] text-white ring-1 ring-white/20 backdrop-blur">
                  Preview
                </span>
              </div>
            </button>

            <p class="mt-3 text-center text-sm font-semibold text-emerald-950">
              {{ $item->title ?? 'Dokumentasi' }}
            </p>
          </div>
        @endforeach
      </div>
    </div>

    @if($galleryCount > 4)
      <div class="flex items-center justify-between">
        <button @click="prev" class="inline-flex items-center justify-center rounded-full border border-emerald-900/15 bg-white px-3 py-2 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition">← Sebelumnya</button>
        <button @click="next" class="inline-flex items-center justify-center rounded-full border border-emerald-900/15 bg-white px-3 py-2 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition">Berikutnya →</button>
      </div>
    @endif
  </div>
@else
  <div class="mt-8 rounded-3xl border border-emerald-900/10 bg-white p-8 text-slate-600">
    Galeri belum tersedia.
  </div>
@endif

  </div>
    {{-- Modal preview untuk galeri --}}
    <div
      x-cloak
      x-show="open"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm"
      x-transition
      @keydown.escape.window="close()"
    >
      <div class="relative w-full max-w-5xl mx-4 rounded-3xl bg-white shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b">
          <p class="text-lg font-semibold text-emerald-950" x-text="title"></p>
          <button type="button" class="text-slate-500 hover:text-emerald-900" @click="close()">✕</button>
        </div>

        <div class="relative">
          <template x-if="slides.length">
            <img :src="slides[index]" class="w-full max-h-[70vh] object-contain bg-slate-100">
          </template>

          <div class="absolute inset-0 flex items-center justify-between px-4">
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-emerald-900 shadow" @click="prev()">←</button>
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-emerald-900 shadow" @click="next()">→</button>
          </div>
        </div>

        <div class="px-6 py-4 border-t overflow-x-auto">
          <div class="flex gap-3">
            <template x-for="(slide, i) in slides" :key="i">
              <button
                type="button"
                class="h-16 w-24 flex-shrink-0 overflow-hidden rounded-xl border"
                :class="i === index ? 'border-emerald-600' : 'border-slate-200'"
                @click="index = i"
              >
                <img :src="slide" class="h-full w-full object-cover">
              </button>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- =========================
   SECTION 3: BERITA (Preview)
========================= --}}
@php
    // Selalu ambil semua berita dari database
    $newsItems = \App\Models\News::orderBy('sort_order')->orderByDesc('published_at')->get();

    // Jika tidak ada di database, coba dari variabel $news
    if ($newsItems->isEmpty() && isset($news)) {
        $newsItems = $news;
    }

    $newsItems = $newsItems->values();
@endphp
<section class="relative py-14 sm:py-16">
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="relative">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">
                Berita
            </p>

            <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-emerald-950">
                Perkembangan & publikasi terkini
            </h2>
        </div>

        @if($newsItems->first())
            <div class="mt-6 flex justify-center sm:absolute sm:right-0 sm:top-1/2 sm:-translate-y-1/2">
                <a
                    href="{{ $newsItems->first()->url }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-900 hover:text-emerald-950 transition"
                    target="_blank"
                    rel="noopener"
                >
                    Lihat berita pertama
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
                    </svg>
                </a>
            </div>
        @endif
    </div>

    @if($newsItems->count())
    <div
        x-data="{
            currentIndex: 0,
            itemsPerPage: 4,
            totalItems: {{ $newsItems->count() }},

            init() {
                this.updateItemsPerPage();
                window.addEventListener('resize', () => this.updateItemsPerPage());
            },

            updateItemsPerPage() {
                if (window.innerWidth < 640) {
                    this.itemsPerPage = 1;
                } else if (window.innerWidth < 1024) {
                    this.itemsPerPage = 2;
                } else {
                    this.itemsPerPage = 4;
                }
            },

            getTotalPages() {
                return Math.ceil(this.totalItems / this.itemsPerPage);
            },

            getCurrentPage() {
                return Math.floor(this.currentIndex / this.itemsPerPage) + 1;
            },

            goNext() {
                if (this.currentIndex + this.itemsPerPage < this.totalItems) {
                    this.currentIndex += this.itemsPerPage;
                }
            },

            goPrev() {
                if (this.currentIndex > 0) {
                    this.currentIndex -= this.itemsPerPage;
                }
            },

            hasNext() {
                return this.currentIndex + this.itemsPerPage < this.totalItems;
            },

            hasPrev() {
                return this.currentIndex > 0;
            }
        }"
        class="relative mt-8"
    >
        <!-- Container Carousel -->
        <div class="overflow-hidden">
            <div
                class="flex transition-transform duration-500 ease-in-out"
                :style="'transform: translateX(-' + (currentIndex * (100 / itemsPerPage)) + '%);'"
            >
                @foreach($newsItems as $item)
                <div
                    class="flex-shrink-0 px-2 sm:px-3"
                    :style="'width: ' + (100 / itemsPerPage) + '%;'"
                >
                    <a
                        href="{{ $item->url }}"
                        target="_blank"
                        rel="noopener"
                        class="group flex h-full flex-col overflow-hidden rounded-3xl border border-emerald-900/10 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                    >
                        @php
                        $imgSrc = null;
                        if ($item->image) {
                            $imgSrc = \Illuminate\Support\Str::startsWith($item->image, ['http://','https://'])
                            ? $item->image
                            : asset('storage/' . $item->image);
                        }
                        @endphp
                        @if($imgSrc)
                        <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100">
                            <img src="{{ $imgSrc }}" alt="{{ $item->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 transition group-hover:opacity-80"></div>
                        </div>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                                {{ optional($item->published_at)->format('d M Y') ?? 'Terbaru' }}
                            </p>
                            <h3 class="mt-2 text-lg font-semibold text-emerald-950 line-clamp-2">
                                {{ $item->title }}
                            </h3>
                            <p class="mt-2 text-sm text-slate-600 line-clamp-3">
                                {{ $item->excerpt }}
                            </p>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-emerald-800">
                                Baca berita
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
                                </svg>
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <div class="mt-6 flex items-center justify-between">
            <button
                @click="goPrev()"
                x-bind:disabled="!hasPrev()"
                class="inline-flex items-center justify-center rounded-full border border-emerald-900/15 bg-white px-4 py-2 text-sm font-semibold transition"
                x-bind:class="hasPrev() ? 'text-emerald-900 hover:bg-emerald-50 cursor-pointer' : 'text-emerald-600 opacity-50 cursor-not-allowed'"
            >
                ← Sebelumnya
            </button>

            <!-- Indikator Halaman -->
            <div class="text-sm text-slate-600">
                <span x-text="getCurrentPage()"></span>
                <span class="mx-1">/</span>
                <span x-text="getTotalPages()"></span>
            </div>

            <button
                @click="goNext()"
                x-bind:disabled="!hasNext()"
                class="inline-flex items-center justify-center rounded-full border border-emerald-900/15 bg-white px-4 py-2 text-sm font-semibold transition"
                x-bind:class="hasNext() ? 'text-emerald-900 hover:bg-emerald-50 cursor-pointer' : 'text-emerald-600 opacity-50 cursor-not-allowed'"
            >
                Berikutnya →
            </button>
        </div>
    </div>
    @else
    <div class="mt-8 rounded-3xl border border-emerald-900/10 bg-white p-8 text-slate-600 text-center">
        Berita belum tersedia.
    </div>
    @endif
</div>
</section>
@endsection
