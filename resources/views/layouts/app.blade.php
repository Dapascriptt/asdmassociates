<!doctype html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

  @php
  use Illuminate\Support\Facades\View;

  $seoTitle = trim(View::yieldContent('title', 'ASDM Associates')) ?: 'ASDM Associates';

  $defaultDescription = 'ASDM Associates - Firma hukum profesional, tegas, dan terpercaya.';
  $seoDescription = trim(View::yieldContent('meta_description', $defaultDescription)) ?: $defaultDescription;

  $seoUrl = trim(View::yieldContent('canonical', url()->current())) ?: url()->current();

  $defaultImage = asset('images/logo.png');
  $seoImage = trim(View::yieldContent('meta_image', $defaultImage)) ?: $defaultImage;

  $seoRobots = trim(View::yieldContent('meta_robots', 'index, follow')) ?: 'index, follow';
@endphp

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="author" content="ASDM Associates">

<title>{{ $seoTitle }}</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<meta name="description" content="{{ $seoDescription }}">
<link rel="canonical" href="{{ $seoUrl }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="ASDM Associates">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:image:alt" content="{{ $seoTitle }}">
<meta property="og:locale" content="id_ID">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
<meta name="twitter:image:alt" content="{{ $seoTitle }}">
    {{-- Font: gunakan Plus Jakarta Sans agar tampak modern --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="h-full bg-page text-slate-800 antialiased selection:bg-emerald-200/60 selection:text-emerald-950">
    {{-- Background global halus (biar ga flat putih) --}}
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-white to-emerald-50/40"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(16,185,129,0.06),transparent_55%)]"></div>
    </div>

    @include('layouts.partials.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @php
      $waRaw = env('APP_WA_NUMBER', '6281254899699');
      $waNumber = preg_replace('/\D+/', '', $waRaw) ?: '6281283800498';
      $waLink = 'https://wa.me/' . $waNumber;
    @endphp
    <a href="{{ $waLink }}" target="_blank" rel="noopener"
       class="fixed bottom-5 right-5 z-50 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/40 hover:bg-emerald-600 transition"
       aria-label="WhatsApp">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
        <path d="M20.52 3.48A11.87 11.87 0 0 0 12.04.9C5.65 1 .31 5.99.08 12.37c-.08 2.01.41 3.96 1.42 5.69L0 24l6.07-1.57a11.9 11.9 0 0 0 5.62 1.42h.46c6.35-.22 11.38-5.6 11.16-11.95a11.87 11.87 0 0 0-2.79-8.42ZM12 21.42c-1.75 0-3.45-.49-4.93-1.41l-.35-.21-3.6.93.96-3.51-.23-.36a9.38 9.38 0 0 1-1.45-5.11C2.53 6.6 7 2.23 12.39 2.4c5.11.16 9.17 4.45 9.01 9.56a9.39 9.39 0 0 1-9.4 9.46h0ZM17.05 14c-.27-.14-1.61-.8-1.86-.9-.25-.09-.43-.14-.62.14-.19.27-.71.9-.87 1.08-.16.18-.32.2-.59.07-.27-.13-1.12-.41-2.14-1.3-.79-.7-1.32-1.57-1.48-1.84-.16-.27-.02-.42.12-.56.12-.12.27-.32.41-.48.14-.16.19-.27.28-.45.09-.18.05-.34-.02-.48-.07-.14-.62-1.49-.85-2.04-.22-.52-.44-.45-.62-.46-.16-.01-.34-.01-.52-.01-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.3 0 1.36.99 2.67 1.12 2.85.14.18 1.94 3.11 4.71 4.36.66.29 1.18.46 1.58.59.66.21 1.26.18 1.74.11.53-.08 1.61-.66 1.84-1.29.23-.63.23-1.17.16-1.29-.07-.11-.25-.18-.52-.31Z"/>
      </svg>
    </a>

    @stack('scripts')
</body>
</html>
