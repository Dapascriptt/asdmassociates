@extends('layouts.app')
@section('title', 'Tentang Kami - Firma Hukum Profesional di Balikpapan | ASDM Associates')
@section('meta_description', 'Kenali ASDM Associates, firma hukum di Balikpapan. Tim kami memberikan pendampingan hukum yang tegas, jelas, dan terdokumentasi untuk perkara perdata, pidana, dan korporasi.')
@section('canonical', route('about'))
@section('meta_image', $about?->hero_image ? asset('storage/' . ltrim($about->hero_image, '/')) : asset('images/about-og-image.jpg'))

@section('content')

{{-- HERO --}}
<section class="mx-auto max-w-7xl px-4 pt-14 pb-10">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
    {{-- Left --}}
    <div class="lg:col-span-7">
      <p class="text-sm font-semibold uppercase tracking-widest text-emerald-800">
        Tentang Kami
      </p>

      {{-- Paragraf 1 --}}
      @if($about?->intro_1)
        <p class="mt-5 text-slate-600 leading-relaxed text-justify">
          {{ $about->intro_1 }}
        </p>
      @endif

      {{-- Paragraf 2 --}}
      @if($about?->intro_2)
        <p class="mt-4 text-slate-600 leading-relaxed text-justify">
          {{ $about->intro_2 }}
        </p>
      @endif

      {{-- CTA --}}
      <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('contact') ?? '#' }}"
           class="inline-flex items-center justify-center rounded-full bg-emerald-800 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-900 transition">
          Hubungi Kami
        </a>
        <a href="{{ route('services') ?? '#' }}"
           class="inline-flex items-center justify-center rounded-full border border-emerald-900/20 px-6 py-3 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition">
          Lihat Layanan
        </a>
      </div>
    </div>

    {{-- Right Image --}}
    <div class="lg:col-span-5">
      <div class="group rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden hover:shadow-md transition">
        <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-100">
          @if($about?->hero_image)
            <img
              src="{{ asset('storage/' . $about->hero_image) }}"
              alt="ASDM Associates"
              class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
              onerror="this.remove(); this.parentElement.querySelector('[data-fallback]').classList.remove('hidden');"
            />
          @else
            <script>
              document.currentScript.parentElement
                .querySelector('[data-fallback]')
                ?.classList.remove('hidden');
            </script>
          @endif

          <div data-fallback class="hidden absolute inset-0">
            <div class="h-full w-full bg-gradient-to-br from-emerald-900 via-emerald-800 to-slate-900 opacity-90"></div>
            <div class="absolute inset-0 p-8 flex flex-col justify-end">
              <p class="text-white/90 text-sm font-semibold tracking-wide">ASDM Associates</p>
              <p class="mt-2 text-white text-xl font-bold leading-snug">
                Pendampingan hukum yang rapi, jelas, dan terdokumentasi.
              </p>
              <p class="mt-3 text-white/80 text-sm leading-relaxed">
                Konsultasi, penyusunan dokumen, hingga penyelesaian sengketa dengan pendekatan yang terukur.
              </p>
            </div>
          </div>

          <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
        </div>

        <div class="p-6">
          <h3 class="text-base font-bold text-emerald-950">
            {{ $about?->hero_title ?: 'Pendampingan hukum yang rapi dan terstruktur' }}
          </h3>
          <p class="mt-2 text-sm text-slate-600 leading-relaxed text-justify">
            {{ $about?->hero_subtitle ?: 'Kami membantu klien memahami posisi hukum, risiko, dan opsi penyelesaian terbaik melalui langkah kerja yang transparan dan terdokumentasi.' }}
          </p>

          {{-- Key points --}}
          <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
            @php
              $pillarsRaw = $about?->hero_points ?? [];
              $pillars = collect($pillarsRaw)->filter()->values();
              if ($pillars->isEmpty()) {
                $pillars = collect([
                  'Analisis awal - Pemetaan risiko & strategi',
                  'Dokumentasi - Tertulis & transparan',
                  'Kerahasiaan - Menjaga data & privasi',
                  'Solutif - Opsi yang realistis',
                ]);
              }
            @endphp
            @foreach($pillars as $item)
              @php $parts = explode('-', $item, 2); @endphp
              <div class="flex items-start gap-3 rounded-2xl bg-slate-50 border border-slate-100 p-3">
                <span class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-xl bg-emerald-50 text-emerald-800 ring-1 ring-emerald-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m5 12 4 4L19 6"/></svg>
                </span>
                <div>
                  <p class="text-sm font-semibold text-slate-900">{{ trim($parts[0]) }}</p>
                  @if(isset($parts[1]))
                    <p class="text-xs text-slate-600">{{ trim($parts[1]) }}</p>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Galeri (menggantikan visi/misi) --}}
@php $aboutImages = collect($about->about_images ?? [])->filter(); @endphp
@if($aboutImages->isNotEmpty())
  <section class="bg-slate-50 border-y border-slate-100 -mt-10 pt-10 pb-14">
    <div class="mx-auto max-w-7xl px-4">
      <div class="text-center max-w-3xl mx-auto">
        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">Foto Lokasi</p>
      </div>

      <div
        x-data="{ idx: 0, imgs: {{ $aboutImages->values()->toJson() }} }"
        class="mt-8 mx-auto max-w-3xl px-3 sm:px-0 relative overflow-hidden rounded-3xl border border-emerald-900/10 bg-white shadow-sm"
      >
        <div class="relative aspect-[3/2] w-full overflow-hidden bg-slate-100">
          <template x-for="(img, i) in imgs" :key="i">
            <img
              x-show="idx === i"
              x-transition.opacity.duration.400ms
              :src="'{{ asset('storage') }}/' + img"
              alt="Galeri Tentang Kami"
              loading="lazy"
              class="h-full w-full object-cover object-center"
            >
          </template>
        </div>

        <div class="absolute inset-0 flex items-center justify-between px-2">
          <button
            type="button"
            @click="idx = (idx - 1 + imgs.length) % imgs.length"
            class="rounded-full bg-white/80 backdrop-blur px-2.5 py-1.5 text-sm text-emerald-900 shadow hover:bg-white transition"
            aria-label="Sebelumnya"
          ><</button>
          <button
            type="button"
            @click="idx = (idx + 1) % imgs.length"
            class="rounded-full bg-white/80 backdrop-blur px-2.5 py-1.5 text-sm text-emerald-900 shadow hover:bg-white transition"
            aria-label="Selanjutnya"
          >></button>
        </div>

        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1.5">
          <template x-for="(img, i) in imgs" :key="'dot'+i">
            <span
              @click="idx=i"
              class="h-1.5 w-1.5 rounded-full cursor-pointer"
              :class="idx===i ? 'bg-emerald-700' : 'bg-white/70 ring-1 ring-emerald-300/60'"
              role="button"
              :aria-label="'Pilih gambar ' + (i+1)"
            ></span>
          </template>
        </div>
      </div>
    </div>
  </section>
@endif

{{-- Sertifikasi --}}
<section class="mx-auto max-w-7xl px-4 py-14" x-data="{open:false, img:'', title:''}">
  <div class="flex justify-center">
    <div class="text-center max-w-3xl">
      <h2 class="text-2xl font-bold text-emerald-950">
        Sertifikasi
      </h2>
    </div>
  </div>

  <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($certs as $c)
      <div class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm hover:shadow-md transition">
        <div class="flex items-start gap-4">
          <div class="mt-1 flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-800 border border-emerald-100">
            ✔
          </div>
          <div class="flex-1">
            <h3 class="text-lg font-semibold text-emerald-950">
              {{ $c->title }}
            </h3>
            <p class="mt-2 text-slate-600">
              {{ $c->issuer }}{{ $c->year ? ', ' . $c->year : '' }}
            </p>
            @if($c->image)
              <button
                type="button"
                class="mt-3 inline-flex items-center gap-2 rounded-full border border-emerald-900/15 px-3 py-2 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition"
                @click="open=true; img='{{ asset('storage/' . $c->image) }}'; title='{{ addslashes($c->title) }}';"
              >
                Lihat sertifikat
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
                </svg>
              </button>
            @endif
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-slate-500 col-span-full">
        Belum ada data sertifikasi.
      </p>
    @endforelse
  </div>

  {{-- Modal sertifikat --}}
  <div
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur"
    x-transition
    @keydown.escape.window="open=false"
    @click.self="open=false"
  >
    <div class="relative w-full max-w-3xl mx-4 rounded-3xl bg-white shadow-2xl overflow-hidden">
      <div class="flex items-center justify-between px-6 py-4 border-b">
        <p class="text-lg font-semibold text-emerald-950" x-text="title"></p>
        <button type="button" class="text-slate-500 hover:text-emerald-900" @click="open=false">✕</button>
      </div>
      <div class="bg-slate-100 flex items-center justify-center">
        <img :src="img" alt="" class="w-full object-contain max-h-[80vh] mx-auto">
      </div>
    </div>
  </div>
</section>

{{-- Tim --}}
<section class="bg-slate-50 border-t border-slate-100">
  <div class="mx-auto max-w-7xl px-4 py-14">
    <div class="flex justify-center">
      <div class="max-w-3xl text-center">
        <h2 class="text-2xl font-bold text-emerald-950">
        Tim & Partner
        </h2>
      </div>
    </div>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($teams as $member)
        <div class="rounded-3xl bg-white border border-slate-200 p-7 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-4">
            @if($member->photo)
              <img
                src="{{ asset('storage/' . $member->photo) }}"
                alt="{{ $member->name }}"
                class="h-14 w-14 rounded-2xl object-cover bg-slate-100"
              >
            @endif

            <div>
              <h3 class="font-semibold text-emerald-950">
                {{ $member->name }}
              </h3>
              <p class="text-sm text-slate-500">
                {{ $member->position }}
              </p>
            </div>
          </div>

          <p class="mt-4 text-slate-600 text-sm leading-relaxed text-justify">
            {{ $member->bio }}
          </p>

          @if($member->practice_areas)
            <div class="mt-5 flex flex-wrap gap-2">
              @foreach($member->practice_areas as $area)
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-800 border border-emerald-100">
                  {{ $area }}
                </span>
              @endforeach
            </div>
          @endif
        </div>
      @empty
        <p class="text-center text-slate-500 col-span-full">
          Data tim belum tersedia.
        </p>
      @endforelse
    </div>
  </div>
</section>


@endsection
