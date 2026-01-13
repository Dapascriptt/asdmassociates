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
    <div
      x-data="{
        idx: 0,
        slides: {{ $items->values()->toJson() }},
        next(){ this.idx = (this.idx + 1) % this.slides.length },
        prev(){ this.idx = (this.idx - 1 + this.slides.length) % this.slides.length },
        go(i){ this.idx = i },
      }"
      class="relative mt-10 mx-auto max-w-4xl"
    >
      {{-- EMERALD GLOW --}}
      <div class="pointer-events-none absolute -inset-4 rounded-3xl bg-emerald-400/20 blur-3xl"></div>

      {{-- CARD --}}
      <div class="relative rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        {{-- SLIDE AREA --}}
        <div class="relative px-16 sm:px-20 py-10 sm:py-12 min-h-[220px] sm:min-h-[240px] flex items-center">
          <template x-for="(slide, i) in slides" :key="i">
            <div
              x-show="idx === i"
              x-transition:enter="transition ease-out duration-500"
              x-transition:enter-start="opacity-0 transform translate-x-8"
              x-transition:enter-end="opacity-100 transform translate-x-0"
              x-transition:leave="transition ease-in duration-300"
              x-transition:leave-start="opacity-100 transform translate-x-0"
              x-transition:leave-end="opacity-0 transform -translate-x-8"
              class="w-full flex items-center justify-center gap-4 sm:gap-6 absolute inset-0 px-16 sm:px-20"
            >
              {{-- LOGO --}}
              <div class="h-16 w-16 sm:h-20 sm:w-20 shrink-0 overflow-hidden rounded-2xl bg-slate-100 ring-1 ring-slate-200 flex items-center justify-center">
                <template x-if="slide.logo">
                  <img
                    :src="'{{ asset('storage') }}/' + slide.logo"
                    alt="Logo"
                    class="h-full w-full object-contain p-2"
                    loading="lazy"
                  >
                </template>
                <template x-if="!slide.logo">
                  <span class="text-slate-400 text-xs font-semibold">Logo</span>
                </template>
              </div>

              {{-- TEXT --}}
              <div class="min-w-0">
                <p class="text-xs sm:text-sm font-semibold text-emerald-700" x-text="slide.role || 'Mandat'"></p>
                <p class="mt-0.5 text-slate-500 text-xs sm:text-sm" x-text="slide.period || ''"></p>
                <h3 class="mt-3 text-xl sm:text-2xl font-bold text-emerald-950 leading-tight break-words" x-text="slide.company"></h3>
              </div>
            </div>
          </template>

          {{-- NAV --}}
          <div class="absolute inset-y-0 left-4 right-4 flex items-center justify-between pointer-events-none z-10">
            <button
              type="button"
              @click="prev()"
              class="pointer-events-auto h-11 w-11 rounded-full bg-white border border-slate-200
                     text-slate-700 text-xl font-semibold shadow-md hover:bg-slate-50 hover:shadow-lg hover:scale-110 transition-all duration-200 flex items-center justify-center"
              aria-label="Sebelumnya"
            >
              ‹
            </button>

            <button
              type="button"
              @click="next()"
              class="pointer-events-auto h-11 w-11 rounded-full bg-white border border-slate-200
                     text-slate-700 text-xl font-semibold shadow-md hover:bg-slate-50 hover:shadow-lg hover:scale-110 transition-all duration-200 flex items-center justify-center"
              aria-label="Selanjutnya"
            >
              ›
            </button>
          </div>
        </div>

        {{-- DOTS --}}
        <div class="flex items-center justify-center gap-2 py-4 border-t border-slate-100">
          <template x-for="(slide, i) in slides" :key="'dot'+i">
            <button
              type="button"
              @click="go(i)"
              class="h-2.5 w-2.5 rounded-full transition-all duration-300"
              :class="idx===i ? 'bg-emerald-700 scale-125 w-6' : 'bg-slate-300 hover:bg-slate-400'"
              aria-label="Pindah slide"
            ></button>
          </template>
        </div>
      </div>
    </div>
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
