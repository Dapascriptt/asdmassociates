@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp
@php
    $position = $member->position ?: 'Pengacara';

    $title = "{$member->name} - {$position} | ASDM Associates";

    $base = "Profil {$member->name}, {$position} di ASDM Associates Balikpapan.";

    if (!empty($member->specialization)) {
        $extra = " Spesialis {$member->specialization}, berpengalaman menangani perkara hukum secara profesional dan terpercaya.";
    } else {
        $extra = " Berpengalaman menangani perkara perdata, pidana, dan korporasi secara profesional dan terpercaya.";
    }

    // soft limit biar meta description gak kepanjangan
    $description = mb_substr($base . $extra, 0, 160);

    $metaImage = $member->photo
        ? asset('storage/' . ltrim($member->photo, '/'))
        : asset('images/default-member.jpg');
@endphp

@section('title', $title)
@section('meta_description', $description)
@section('canonical', route('member.detail', $member->slug))
@section('meta_image', $metaImage)

@section('content')
<div class="relative bg-gradient-to-b from-emerald-50 via-white to-white">
  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="rounded-3xl border border-emerald-900/10 bg-white shadow-sm p-6 flex flex-col items-center text-center">
        @if($member->photo)
          <div class="w-40 h-40 rounded-2xl overflow-hidden bg-slate-100">
            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="h-full w-full object-cover" loading="lazy">
          </div>
        @endif
        <h1 class="mt-4 text-2xl font-bold text-emerald-950">{{ $member->name }}</h1>
        <p class="text-emerald-700 font-semibold">{{ $member->position }}</p>

        <div class="mt-4 space-y-2 text-sm text-slate-600">
          @if($member->phone)
            <div class="flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 0 0 1.5-1.5v-2.1a1.5 1.5 0 0 0-1.232-1.476l-3.117-.52a1.5 1.5 0 0 0-1.518.74l-.772 1.285a12.035 12.035 0 0 1-5.393-5.393l1.285-.772a1.5 1.5 0 0 0 .74-1.518l-.52-3.117A1.5 1.5 0 0 0 8.85 3.75H6.75A1.5 1.5 0 0 0 5.25 5.25v1.5Z" />
              </svg>
              <span>{{ $member->phone }}</span>
            </div>
          @endif
          @if($member->email)
            <div class="flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a1.5 1.5 0 0 1-1.5 1.5h-16.5a1.5 1.5 0 0 1-1.5-1.5v-10.5a1.5 1.5 0 0 1 1.5-1.5h16.5a1.5 1.5 0 0 1 1.5 1.5Z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m3 7.5 8.25 6 8.25-6" />
              </svg>
              <span>{{ $member->email }}</span>
            </div>
          @endif
          @if($member->linkedin)
            <a href="{{ $member->linkedin }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 text-emerald-800 font-semibold hover:text-emerald-950">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 5 2.12 5 3.5zm.02 4.5H0V24h5V8zM8 8h4.8v2.2h.07c.67-1.27 2.3-2.6 4.73-2.6 5.06 0 6 3.33 6 7.66V24h-5V16.4c0-1.8-.03-4.12-2.51-4.12-2.51 0-2.89 1.96-2.89 3.99V24H8V8z"/>
              </svg>
              LinkedIn
            </a>
          @endif
        </div>
      </div>

      <div class="lg:col-span-2">
        <div x-data="{ tab: 'overview' }" class="rounded-3xl border border-emerald-900/10 bg-white shadow-sm">
          <div class="flex items-center gap-2 border-b border-slate-200 px-4 sm:px-6">
            <button @click="tab='overview'" :class="tab === 'overview' ? 'text-emerald-900 border-emerald-600' : 'text-slate-500 border-transparent'"
              class="py-3 text-sm font-semibold border-b-2 transition">Overview</button>
            <button @click="tab='experience'" :class="tab === 'experience' ? 'text-emerald-900 border-emerald-600' : 'text-slate-500 border-transparent'"
              class="py-3 text-sm font-semibold border-b-2 transition">Experience Highlight</button>
          </div>

          <div class="p-6 space-y-4">
            <div x-show="tab==='overview'" x-cloak>
              <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $member->overview }}</p>
            </div>

            <div x-show="tab==='experience'" x-cloak>
              @php $highlights = collect($member->experience_highlights ?? [])->pluck('item')->filter(); @endphp
              @if($highlights->isNotEmpty())
                <ul class="list-disc space-y-2 pl-4 text-slate-700">
                  @foreach($highlights as $item)
                    <li class="leading-relaxed">{{ $item }}</li>
                  @endforeach
                </ul>
              @else
                <p class="text-slate-500">Belum ada data pengalaman yang ditambahkan.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
