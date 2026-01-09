@extends('layouts.app')
@section('title', 'Firma Hukum Terpercaya di Balikpapan | ASDM Associates')
@section('meta_description', 'ASDM Associates adalah firma hukum profesional di Balikpapan yang menangani perkara perdata, pidana, dan hukum korporasi dengan pengalaman lebih dari 10 tahun. Konsultasi gratis!')
@section('canonical', route('home'))
@section('meta_image', asset('images/home-og-image.jpg'))

@section('content')
<section class="relative overflow-hidden">
  {{-- Background glow --}}
  <div class="absolute inset-0">
    <div class="absolute -top-40 -left-10 h-80 w-80 rounded-full bg-emerald-200/50 blur-3xl"></div>
    <div class="absolute -bottom-52 -right-10 h-96 w-96 rounded-full bg-emerald-300/35 blur-3xl"></div>
  </div>

  <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
    <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-14">

      {{-- LEFT --}}
      <div class="space-y-7">
        <div class="space-y-4 sm:space-y-6">
  <h1
    class="text-4xl font-extrabold leading-tight tracking-tight text-emerald-950 sm:text-5xl"
  >
    Firma Hukum Profesional di Balikpapan,
    <span class="text-emerald-700">Tegas</span>,
    dan Terpercaya
  </h1>

  <p
    class="max-w-2xl text-justify text-base leading-relaxed text-slate-700 sm:text-lg"
  >
    A. Sari Damayanti, S.H., M.H. &amp; Associates merupakan firma hukum yang
    berkedudukan di Balikpapan, menyediakan pendampingan hukum yang terukur,
    responsif, dan berorientasi pada solusi bagi individu maupun perusahaan.
  </p>
</div>


        {{-- CTA --}}
        <div class="flex flex-wrap items-center gap-3">
          <a href="{{ route('contact') }}" class="btn-primary">
            Konsultasi Sekarang
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
            </svg>
          </a>

          <a href="{{ route('services') }}" class="btn-secondary">
            Lihat Layanan
          </a>
        </div>

        {{-- Mini cards --}}
        @php
          $cards = [
            ['title' => 'Konsultasi', 'desc' => 'Terarah & jelas', 'icon' => 'chat'],
            ['title' => 'Litigasi', 'desc' => 'Strategi kuat', 'icon' => 'gavel'],
            ['title' => 'Perusahaan', 'desc' => 'Dokumen rapi', 'icon' => 'building'],
          ];
        @endphp

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
          @foreach($cards as $card)
            <div class="glass-card p-4 ring-1 ring-emerald-900/5 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
              <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                  @if($card['icon'] === 'chat')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8.25 9.75h7.5m-7.5 3h4.5M4.5 6.75h15a.75.75 0 0 1 .75.75v8.25a.75.75 0 0 1-.75.75H8.686a.75.75 0 0 0-.53.22l-2.905 2.904A.75.75 0 0 1 4.5 19.5V7.5a.75.75 0 0 1 .75-.75Z" />
                    </svg>
                  @elseif($card['icon'] === 'gavel')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="m14.25 5.25-3 3m-2.5-.5 3 3m.53 1.97 6.72 6.72M4.5 19.5l6.75-6.75M9 5.25l1.5 1.5m-5.25 9L6 16.5" />
                    </svg>
                  @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3.75 21h16.5M4.5 3.75H9v5.25H4.5zm0 0H9L3.75 9M9 3.75l5.25 5.25m0 0h5.25V3.75H9zm5.25 0V9m0 6.75H21v-5.25h-6.75zm0 0V21m-5.25 0h5.25v-5.25H9zM3 12h6" />
                    </svg>
                  @endif
                </div>

                <div>
                  <p class="font-semibold text-emerald-950">{{ $card['title'] }}</p>
                  <p class="text-sm text-slate-600">{{ $card['desc'] }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- RIGHT (Refined / less nested cards) --}}
      <div class="dark-card relative overflow-hidden p-8 sm:p-10">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/5 blur-3xl"></div>

        {{-- Header --}}
        <div class="flex items-start justify-between gap-4">
          <div>
            <p class="text-2xl font-semibold text-white">Kenapa ASDM Associates?</p>
            <p class="mt-2 text-sm leading-relaxed text-white/70">
              Pendampingan hukum yang rapi, terukur, dan berorientasi solusi.
            </p>
          </div>

          <span class="badge-soft hidden sm:inline-flex">Trust · Strategy · Clarity</span>
        </div>

        {{-- CTA (no extra card) --}}
        <div class="mt-8 flex flex-col gap-4 rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
          <p class="text-sm text-white/75">
            Butuh arahan hukum yang jelas? Mulai dari konsultasi singkat.
          </p>

          <div class="flex flex-wrap items-center gap-3">
            <a
              href="{{ route('contact') }}"
              class="inline-flex items-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-emerald-950 transition hover:-translate-y-0.5"
            >
              Hubungi Kami
            </a>
            <span class="text-xs uppercase tracking-wide text-white/60">
              Senin–Jumat · 08.00–17.00
            </span>
          </div>
        </div>

        {{-- Key benefit (lighter) --}}
        <div class="mt-6 rounded-2xl bg-white p-5 text-emerald-950 shadow-lg">
          <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M7.5 8.25h9m-9 3h5.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>
            <div>
              <p class="text-sm font-semibold">Konsultasi awal yang terarah</p>
              <p class="mt-1 text-sm text-slate-700">
                Kami bantu memetakan posisi hukum, risiko, dan langkah yang paling relevan sejak awal.
              </p>
            </div>
          </div>
        </div>

        {{-- Micro trust line --}}

      </div>

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
