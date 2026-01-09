@extends('layouts.app')
@section('title', 'Hubungi Kami - ASDM Associates')
@section('meta_description', 'Kontak ASDM Associates untuk konsultasi hukum: telepon, email, alamat kantor, dan jam kerja.')
@section('canonical', route('contact'))

@php
  $heroTitle = $contact->hero_title ?? 'Hubungi ASDM Associates';
  $heroSubtitle = $contact->hero_subtitle ?? 'Kami siap merespons pertanyaan atau kebutuhan hukum Anda.';
  $phone = $contact->phone ?? '+62 0000 0000';
  $email = $contact->email ?? 'contact@asdmassociates.com';
  $emailAlt = $contact->email_alt ?? null;
  $address = $contact->address ?? 'Alamat belum diisi';
  $hours = $contact->working_hours ?? '08.00 – 17.00';
  $mapEmbed = $contact->map_embed ?? '';
@endphp

@section('content')
<section class="mx-auto max-w-7xl px-4 pt-14 pb-10">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
    <div>
      <p class="text-sm font-semibold uppercase tracking-widest text-emerald-800">Kontak</p>
      <h1 class="mt-3 text-3xl sm:text-4xl font-bold text-emerald-950">{{ $heroTitle }}</h1>
      <p class="mt-3 text-slate-600 leading-relaxed">{{ $heroSubtitle }}</p>
      <p class="mt-2 text-sm text-slate-500">Respon cepat di jam kerja. Silakan pilih kanal kontak atau isi formulir.</p>
      <div class="mt-6 flex flex-wrap gap-3">
        <a href="tel:{{ preg_replace('/\\s+/', '', $phone) }}" class="inline-flex items-center rounded-full bg-emerald-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-900 transition">
          Telepon/WA
        </a>
        <a href="mailto:{{ $email }}" class="inline-flex items-center rounded-full border border-emerald-900/20 px-5 py-2.5 text-sm font-semibold text-emerald-900 hover:bg-emerald-50 transition">
          Email
        </a>
      </div>
    </div>

    <div class="rounded-3xl border border-emerald-900/10 bg-white shadow-sm p-6">
      <h2 class="text-xl font-semibold text-emerald-950">Kirim Pesan</h2>
      <p class="text-sm text-slate-600 mt-1">Formulir ini akan diteruskan ke email tim ASDM Associates.</p>
      @if (session('status'))
        <div class="mt-3 rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-900 text-sm">
          {{ session('status') }}
        </div>
      @endif
      <form action="{{ route('contact.send') }}" method="POST" class="mt-4 space-y-3">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <input type="text" name="name" required placeholder="Nama *" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
          <input type="email" name="email" required placeholder="Email *" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <input type="text" name="phone" placeholder="Telepon / WA" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
          <input type="text" name="company" placeholder="Perusahaan (opsional)" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
        </div>
        <input type="text" name="subject" placeholder="Perihal" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
        <textarea name="message" rows="4" required placeholder="Pesan" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"></textarea>
        <button type="submit" class="inline-flex items-center rounded-full bg-emerald-800 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-900 transition">
          Kirim Pesan
        </button>
      </form>
    </div>
  </div>
</section>

<section class="bg-slate-900 text-white py-10">
  <div class="mx-auto max-w-5xl px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-white/10">
    <div class="flex flex-col items-center gap-2 py-6">
      <div class="h-14 w-14 rounded-full bg-white/10 flex items-center justify-center text-emerald-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 0 0 1.5-1.5v-2.1a1.5 1.5 0 0 0-1.232-1.476l-3.117-.52a1.5 1.5 0 0 0-1.518.74l-.772 1.285a12.035 12.035 0 0 1-5.393-5.393l1.285-.772a1.5 1.5 0 0 0 .74-1.518l-.52-3.117A1.5 1.5 0 0 0 8.85 3.75H6.75A1.5 1.5 0 0 0 5.25 5.25v1.5Z" /></svg>
      </div>
      <p class="text-sm font-semibold tracking-wide uppercase">Phone</p>
      <a href="tel:{{ preg_replace('/\\s+/', '', $phone) }}" class="text-emerald-100 hover:text-emerald-200 text-sm">{{ $phone }}</a>
    </div>

    <div class="flex flex-col items-center gap-2 py-6">
      <div class="h-14 w-14 rounded-full bg-white/10 flex items-center justify-center text-emerald-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a1.5 1.5 0 0 1-1.5 1.5h-16.5a1.5 1.5 0 0 1-1.5-1.5v-10.5a1.5 1.5 0 0 1 1.5-1.5h16.5a1.5 1.5 0 0 1 1.5 1.5Z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m3 7.5 8.25 6 8.25-6" /></svg>
      </div>
      <p class="text-sm font-semibold tracking-wide uppercase">Emails</p>
      <a href="mailto:{{ $email }}" class="text-emerald-100 hover:text-emerald-200 text-sm">{{ $email }}</a>
      @if($emailAlt)
        <a href="mailto:{{ $emailAlt }}" class="text-emerald-100 hover:text-emerald-200 text-sm">{{ $emailAlt }}</a>
      @endif
    </div>

    <div class="flex flex-col items-center gap-2 py-6 px-4 text-center">
      <div class="h-14 w-14 rounded-full bg-white/10 flex items-center justify-center text-emerald-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 1 0-9-9c0 5 4 9 9 9Z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12v-4m0 8h.01" /></svg>
      </div>
      <p class="text-sm font-semibold tracking-wide uppercase">Address</p>
      <p class="text-emerald-100 text-sm leading-relaxed">{{ $address }}</p>
    </div>

    <div class="flex flex-col items-center gap-2 py-6">
      <div class="h-14 w-14 rounded-full bg-white/10 flex items-center justify-center text-emerald-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l3 3" /></svg>
      </div>
      <p class="text-sm font-semibold tracking-wide uppercase">Working Hours</p>
      <p class="text-emerald-100 text-sm">{{ $hours }}</p>
    </div>
  </div>
</section>

@if($mapEmbed)
  <section class="mx-auto max-w-7xl px-4 py-10">
    <div class="overflow-hidden rounded-3xl border border-slate-200 shadow-sm">
      <iframe src="{{ $mapEmbed }}" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>
@endif
@endsection
