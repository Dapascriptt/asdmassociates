@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-b from-emerald-50 via-white to-white">
  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-14 sm:py-16">
    <div class="text-center">
      <p class="text-sm font-semibold uppercase tracking-wide text-emerald-800">Member</p>
      <h1 class="mt-2 text-3xl sm:text-4xl font-bold text-emerald-950">Tim Advokat & Konsultan</h1>
    </div>

    <div class="mt-10">
      @if($members->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          @foreach($members as $member)
            <a
              href="{{ route('member.detail', $member->slug) }}"
              class="group flex flex-col rounded-xl border border-emerald-900/10 bg-white shadow-sm
                     hover:-translate-y-0.5 hover:shadow-md transition duration-300
                     max-w-[220px] mx-auto w-full"
            >
              @if($member->photo)
                <div class="aspect-[3/4] overflow-hidden rounded-t-xl bg-slate-100">
                  <img
                    src="{{ asset('storage/' . $member->photo) }}"
                    alt="{{ $member->name }}"
                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                  >
                </div>
              @endif

              <div class="p-3 flex-1">
                <p class="text-[10px] font-semibold uppercase tracking-wide text-emerald-700">
                  {{ $member->position }}
                </p>
                <h3 class="mt-1 text-base font-semibold text-emerald-950">
                  {{ $member->name }}
                </h3>

                @if($member->overview)
                  <p class="mt-1.5 text-sm text-slate-600 line-clamp-2">
                    {{ $member->overview }}
                  </p>
                @endif
              </div>

              <div class="px-3 pb-3">
                <span class="inline-flex items-center gap-1 text-sm font-semibold text-emerald-800">
                  Lihat profil
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0-5.25-5.25M19.5 12l-5.25 5.25" />
                  </svg>
                </span>
              </div>
            </a>
          @endforeach
        </div>
      @else
        <div class="mt-8 rounded-3xl border border-emerald-900/10 bg-white p-8 text-center text-slate-600">
          Data member belum tersedia.
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
