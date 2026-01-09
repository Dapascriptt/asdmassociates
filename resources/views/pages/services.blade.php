@extends('layouts.app')
@section('title', 'Layanan Hukum di Balikpapan - Perdata, Pidana, Korporasi | ASDM Associates')

@section('meta_description', 'Layanan konsultasi hukum, pendampingan litigasi, legal audit, dan penyusunan kontrak untuk individu maupun perusahaan di Balikpapan. Hubungi kami untuk konsultasi gratis!')

@section('canonical', route('services'))

@section('meta_image', asset('images/services-og-image.jpg'))

@section('content')

@php
  // Icon set reusable
  $icons = [
    'scale' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v18m-7-6h14M7 15l-2 3h14l-2-3M6 9l2-3h8l2 3" />',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />',
    'gavel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 4 4 14m10-10 6 6M9 9l6 6M7 21h10" />',
    'building' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M6 21V7l6-4 6 4v14M9 21v-6h6v6" />',
    'doc' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 3h7l3 3v15a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />',
    'hand' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 13V7a1 1 0 0 1 2 0v6m0 0V6a1 1 0 0 1 2 0v7m0 0V7a1 1 0 0 1 2 0v6m0 0V9a1 1 0 0 1 2 0v5a6 6 0 0 1-6 6H9a4 4 0 0 1-4-4v-2a1 1 0 0 1 2 0v1" />',
    'chat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h8M8 14h5M21 12a8 8 0 1 1-4-7l4-1-1 4a7.98 7.98 0 0 1 1 4Z" />',
  ];

  // Data dari Filament (jika ada)
  $servicesMain = isset($servicesMain) ? $servicesMain : collect();
  $servicesExtra = isset($servicesExtra) ? $servicesExtra : collect();
  $noServiceData = $servicesMain->isEmpty() && $servicesExtra->isEmpty();

  // Helper untuk items (dari JSON array atau textarea newline)
  $mapItems = function($items) {
    if (is_array($items)) return array_filter($items);
    return array_filter(array_map('trim', explode("\n", (string) $items)));
  };
@endphp

{{-- HERO --}}
<section class="relative mx-auto max-w-7xl px-4 pt-14 pb-10 overflow-hidden">

  {{-- AMBIENT EMERALD GLOWS (DI PINGGIR, RANDOM) --}}
  <div class="pointer-events-none absolute inset-0 -z-10">

    {{-- kiri atas --}}
    <div class="absolute -top-32 -left-40 h-[420px] w-[420px] rounded-full bg-emerald-400/20 blur-3xl"></div>

    {{-- kanan atas --}}
    <div class="absolute -top-24 -right-48 h-[360px] w-[360px] rounded-full bg-emerald-300/20 blur-3xl"></div>

    {{-- kiri bawah --}}
    <div class="absolute -bottom-40 -left-32 h-[380px] w-[380px] rounded-full bg-emerald-500/15 blur-3xl"></div>

    {{-- kanan bawah (lebih kecil) --}}
    <div class="absolute bottom-10 -right-24 h-[260px] w-[260px] rounded-full bg-emerald-400/20 blur-3xl"></div>

  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
    {{-- Left --}}
    <div class="lg:col-span-7">
      <p class="text-sm font-semibold uppercase tracking-widest text-emerald-800">
        Layanan
      </p>

      <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-emerald-950">
        Pendampingan hukum yang rapi, jelas, dan terukur.
      </h1>

      <p class="mt-4 text-slate-600 leading-relaxed text-justify">
        ASDM Associates menyediakan pendampingan hukum untuk individu maupun badan usaha.
        Kami membantu Anda memahami posisi hukum, memetakan risiko, dan memilih langkah terbaik
        melalui proses yang transparan serta terdokumentasi.
      </p>

      {{-- CTA --}}
      <div class="mt-7 flex flex-wrap gap-3">
        <a href="{{ route('contact') ?? '#' }}"
           class="inline-flex items-center justify-center rounded-full bg-emerald-800 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-900 transition">
          Konsultasi Sekarang
        </a>
        <a href="#layanan"
           class="inline-flex items-center justify-center rounded-full border border-emerald-900/20 px-6 py-3 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition">
          Lihat Semua Layanan
        </a>
      </div>
    </div>

    {{-- Right --}}
    @php
      $heroTitle = $serviceContent->hero_title ?? 'Pendampingan hukum yang rapi dan terukur';
      $heroSubtitle = $serviceContent->hero_subtitle ?? 'Kami membantu klien memahami posisi hukum, risiko, dan opsi penyelesaian terbaik melalui langkah kerja yang transparan dan terdokumentasi.';
      $heroImage = $serviceContent->hero_image ?? null;
      $heroPoints = $serviceContent?->hero_points ?? [];
    @endphp

    <div class="lg:col-span-5">
      <div class="group rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden hover:shadow-md transition">
        {{-- Media --}}
        <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-100">
          @if($heroImage)
            <img
              src="{{ asset('storage/' . $heroImage) }}"
              alt="{{ $heroTitle }}"
              class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
            />
          @endif
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-4">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
              Layanan unggulan
            </p>
            <h3 class="mt-1 text-lg font-bold text-emerald-950">
              {{ $heroTitle }}
            </h3>
            <p class="mt-2 text-sm text-slate-600 leading-relaxed">
              {{ $heroSubtitle }}
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>


{{-- CARDS --}}
<section id="layanan" class="mx-auto max-w-7xl px-4 pb-14">
  <div class="text-center max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-emerald-950">Layanan Utama</h2>
  </div>

  @if($noServiceData)
    <div class="mt-10 rounded-3xl border border-dashed border-emerald-200 bg-white p-8 text-center text-slate-600">
      <p class="font-semibold text-emerald-900">Belum ada layanan yang diinput.</p>
    </div>
  @else
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($servicesMain as $srv)
        <div class="group rounded-3xl border border-slate-200 bg-white p-7 shadow-sm hover:shadow-md hover:-translate-y-1 transition">
          <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-800 border border-emerald-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {!! $icons[$srv['icon'] ?? ''] ?? '' !!}
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-emerald-950 leading-snug">
              {{ $srv['title'] ?? $srv->title }}
            </h3>
          </div>

          <p class="mt-4 text-sm text-slate-600 leading-relaxed text-justify">
            {{ $srv['description'] ?? $srv->description }}
          </p>

          <ul class="mt-5 space-y-2 text-sm text-slate-600">
            @foreach($mapItems($srv['items'] ?? $srv->items ?? []) as $it)
              <li class="flex gap-3">
                <span class="mt-2 h-2 w-2 rounded-full bg-emerald-700"></span>
                <p class="leading-relaxed">{{ $it }}</p>
              </li>
            @endforeach
          </ul>

          <div class="mt-6">
            <a href="{{ route('contact') ?? '#' }}"
               class="inline-flex text-sm font-semibold text-emerald-800 hover:text-emerald-900 transition">
              Konsultasi →
            </a>
          </div>
        </div>
      @endforeach
    </div>
  @endif


  @if(!$noServiceData && $servicesExtra->count())
    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
      @foreach($servicesExtra as $srv)
        <div class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-800 border border-emerald-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {!! $icons[$srv['icon'] ?? ''] ?? '' !!}
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-emerald-950 leading-snug">
              {{ $srv['title'] ?? $srv->title }}
            </h3>
          </div>

          <p class="mt-4 text-sm text-slate-600 leading-relaxed text-justify">
            {{ $srv['description'] ?? $srv->description }}
          </p>

          <ul class="mt-5 space-y-2 text-sm text-slate-600">
            @foreach($mapItems($srv['items'] ?? $srv->items ?? []) as $it)
              <li class="flex gap-3">
                <span class="mt-2 h-2 w-2 rounded-full bg-emerald-700"></span>
                <p class="leading-relaxed">{{ $it }}</p>
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>
  @endif
</section>

{{-- CTA Banner --}}
<section class="bg-slate-50 border-y border-slate-100 py-12">
  <div class="mx-auto max-w-7xl px-4">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
      <div>
        <h3 class="text-xl font-bold text-emerald-950">Butuh konsultasi cepat?</h3>
        <p class="mt-2 text-slate-600 leading-relaxed">
          Sampaikan ringkas masalah Anda. Kami bantu petakan opsi langkah hukum dan dokumen yang dibutuhkan.
        </p>
      </div>
      <div class="flex flex-wrap gap-3">
        <a href="{{ route('contact') ?? '#' }}"
           class="inline-flex items-center justify-center rounded-full bg-emerald-800 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-900 transition">
          Hubungi Kami
        </a>
        <a href="#layanan"
           class="inline-flex items-center justify-center rounded-full border border-emerald-900/20 px-6 py-3 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition">
          Lihat Layanan
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
