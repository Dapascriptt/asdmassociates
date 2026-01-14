@extends('layouts.app')
@section('title', 'Portofolio - ASDM Associates')
@section('meta_description', 'Portofolio kasus dan daftar klien ASDM Associates.')
@section('canonical', route('portfolio'))

@php
  $items = $portfolioItems ?? collect();
  $partners = $partners ?? collect();
  $clients = $clients ?? collect();
@endphp

@section('content')
<section class="mx-auto max-w-7xl px-4 pt-14 pb-10">
  <div class="text-center">
    <p class="text-sm font-semibold uppercase tracking-widest text-emerald-800">Portofolio</p>
    <h1 class="mt-2 text-3xl sm:text-4xl font-bold text-emerald-950">
      Kasus yang telah ditangani
    </h1>
  </div>

  @if($items->isNotEmpty())
   <div class="mt-6 mx-auto max-w-7xl px-4">
  {{-- HORIZONTAL SCROLL CONTAINER --}}
  <div class="overflow-x-auto pb-4 scrollbar-hide">
    <div class="flex gap-6 min-w-max">
      @foreach($items as $item)
      <div class="relative group w-80 flex-shrink-0">
        {{-- EMERALD GLOW --}}
        <div class="pointer-events-none absolute -inset-2 rounded-2xl bg-emerald-400/20 blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        {{-- CARD --}}
        <div class="relative rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden h-full">
          <div class="p-6 flex flex-col items-center text-center h-72">
            {{-- LOGO --}}
            <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-slate-100 ring-1 ring-slate-200 flex items-center justify-center mb-4">
              @if($item->logo)
                <img
                  src="{{ asset('storage/' . $item->logo) }}"
                  alt="Logo"
                  class="h-full w-full object-contain p-3"
                  loading="lazy"
                >
              @else
                <span class="text-slate-400 text-sm font-semibold">Logo</span>
              @endif
            </div>

            {{-- TEXT --}}
            <div class="flex-1 flex flex-col justify-start">
              <p class="text-base font-semibold text-emerald-700">{{ $item->role ?? 'Kuasa Hukum' }}</p>
              @if($item->period)
                <p class="mt-1 text-slate-500 text-sm">{{ $item->period }}</p>
              @endif
              <h3 class="mt-3 text-xl font-bold text-emerald-950 leading-tight break-words line-clamp-3">{{ $item->company }}</h3>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<style>
  /* Hide scrollbar for Chrome, Safari and Opera */
  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }

  /* Hide scrollbar for IE, Edge and Firefox */
  .scrollbar-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
  }

  /* Line clamp utility */
  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>

<style>
  /* Hide scrollbar for Chrome, Safari and Opera */
  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }

  /* Hide scrollbar for IE, Edge and Firefox */
  .scrollbar-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
  }
</style>
  @else
    <p class="mt-8 text-center text-slate-500">Belum ada portofolio yang ditambahkan.</p>
  @endif
</section>

<section class="bg-slate-50 border-y border-slate-100 py-12 space-y-10">
  <div class="mx-auto max-w-7xl px-4 space-y-10">
    {{-- Mitra --}}
    <div>
      <div class="text-center">
        <p class="text-sm font-semibold uppercase tracking-widest text-emerald-800">Partner</p>
        <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-emerald-950">Dipercaya Oleh Berbagai Pihak</h2>
      </div>

    @if($partners->isNotEmpty())
      <div class="mt-6 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white/70 backdrop-blur">
        <div class="relative py-6">
          <div class="pointer-events-none absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-white/70 to-transparent z-10"></div>
          <div class="pointer-events-none absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-white/70 to-transparent z-10"></div>

          <div class="logo-slider-wrapper relative">
            <div class="logo-track flex items-center gap-10">
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
        <p class="mt-4 text-center text-slate-500">Belum ada mitra yang ditambahkan.</p>
      @endif
    </div>

    {{-- Klien --}}
    <div>
      <div class="text-center">
        <p class="text-sm font-semibold uppercase tracking-widest text-emerald-800">Klien</p>
        <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-emerald-950">Klien yang mempercayai kami</h2>
      </div>

    @if($clients->isNotEmpty())
      <div class="mt-6 overflow-hidden rounded-3xl border border-emerald-900/10 bg-white/70 backdrop-blur">
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
      @else
        <p class="mt-4 text-center text-slate-500">Belum ada klien yang ditambahkan.</p>
      @endif
    </div>
  </div>
</section>

@endsection
