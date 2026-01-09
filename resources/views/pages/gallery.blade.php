@extends('layouts.app')
@section('title', 'Galeri - ASDM Associates')

@section('content')
<section
  class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-14 pb-10"
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

  {{-- EMERALD BACKGROUND GLOW --}}
  <div class="pointer-events-none absolute inset-x-0 -top-24 -bottom-24 -z-10">
    <div class="mx-auto h-full max-w-5xl rounded-full bg-emerald-400/20 blur-3xl"></div>
  </div>

  {{-- HEADER --}}
  <div class="text-center max-w-3xl mx-auto">
    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">Galeri</p>
    <h1 class="mt-2 text-3xl font-bold text-emerald-950">
      Dokumentasi kegiatan & momen
    </h1>
  </div>

  @php
    $items = $galleries ?? collect();
  @endphp

  @if($items->count())
    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($items as $gallery)
        @php
          $images = collect($gallery->images ?? [])
            ->filter()
            ->map(fn($img) => asset('storage/' . $img))
            ->values();
          if ($images->isEmpty() && $gallery->image) {
              $images->push(asset('storage/' . $gallery->image));
          }
          $thumb = $images->first();
        @endphp

        <div class="group relative">
          <button
            type="button"
            class="relative z-10 w-full text-left rounded-3xl border border-emerald-900/10 bg-white shadow-sm
                   overflow-hidden transition hover:-translate-y-1 hover:shadow-lg"
            @click='show(@json($images), @json($gallery->title ?? "Dokumentasi"))'
          >
            <div class="relative aspect-[4/3] w-full overflow-hidden bg-slate-100">
              @if($thumb)
                <img
                  src="{{ $thumb }}"
                  alt="{{ $gallery->title ?? 'Dokumentasi' }}"
                  class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                >
              @endif
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>
            </div>

            <div class="p-4">
              <p class="text-sm font-semibold text-emerald-950">
                {{ $gallery->title ?? 'Dokumentasi' }}
              </p>
              <p class="mt-1 text-xs text-slate-600">
                Klik untuk lihat lebih banyak foto
              </p>
            </div>
          </button>
        </div>
      @endforeach
    </div>

    {{-- MODAL --}}
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
          <button
            type="button"
            class="text-slate-500 hover:text-emerald-900"
            @click="close()"
          >✕</button>
        </div>

        <div class="relative">
          <template x-if="slides.length">
            <img
              :src="slides[index]"
              class="w-full max-h-[70vh] object-contain bg-slate-100"
            >
          </template>

          <div class="absolute inset-0 flex items-center justify-between px-4">
            <button
              type="button"
              class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-emerald-900 shadow"
              @click="prev()"
            >←</button>
            <button
              type="button"
              class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-emerald-900 shadow"
              @click="next()"
            >→</button>
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
  @else
    <div class="mt-10 rounded-3xl border border-emerald-900/10 bg-white p-8 text-center text-slate-600">
      Galeri belum tersedia.
    </div>
  @endif
</section>
@endsection
