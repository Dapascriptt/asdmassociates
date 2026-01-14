{{-- NAVBAR (FULL CODE – DESKTOP + MOBILE) --}}
<div class="h-24 md:h-20"></div>

<header
  x-data="{
    y: 0,
    scrolled: false,
    onScroll(){
      this.y = window.scrollY || 0
      this.scrolled = this.y > 20
    }
  }"
  x-init="
    onScroll();
    window.addEventListener('scroll', () => {
      onScroll();
      document.dispatchEvent(new CustomEvent('close-mobile-menu'));
    }, { passive:true })
  "
  class="fixed inset-x-0 top-0 z-50"
>
  <div
    :class="scrolled
      ? 'mx-auto mt-4 w-full rounded-3xl bg-white/90 ring-1 ring-emerald-900/10 shadow-2xl shadow-black/15'
      : 'mx-auto w-full rounded-none bg-emerald-950/95 ring-0 shadow-none'"
    :style="`transform: translateY(${Math.min(y, 10)}px)`"
    class="border-b border-emerald-900/10 backdrop-blur transition-all duration-300"
  >
    <div class="mx-auto grid h-20 w-full grid-cols-[auto,1fr,auto] items-center px-4 sm:px-6 lg:px-10 gap-4">


      {{-- LEFT --}}
      <a href="{{ route('home') }}" class="flex items-center">
        <img
          src="{{ asset('images/logo.png') }}"
          alt="ASDM Associates"
          class="h-14 w-auto object-contain transition-all duration-300"
          :class="scrolled ? 'brightness-110' : 'brightness-100'"
        >
      </a>

      {{-- CENTER: Desktop Menu --}}
      <nav
        :class="scrolled ? 'text-emerald-900' : 'text-white/80'"
        class="hidden md:flex items-center justify-center gap-1 text-sm transition-colors duration-300"
      >
        @php
          $navItem = "inline-flex items-center h-12 px-4 whitespace-nowrap rounded-xl transition-colors duration-300";
        @endphp

        <a href="{{ route('home') }}" class="{{ $navItem }}"
           :class="scrolled ? 'hover:text-emerald-950' : 'hover:text-white'">Beranda</a>


        <a href="{{ route('services') }}" class="{{ $navItem }}"
           :class="scrolled ? 'hover:text-emerald-950' : 'hover:text-white'">Layanan</a>

        <a href="{{ route('portfolio') }}" class="{{ $navItem }}"
           :class="scrolled ? 'hover:text-emerald-950' : 'hover:text-white'">Portofolio</a>

        <a href="{{ route('gallery') }}" class="{{ $navItem }}"
           :class="scrolled ? 'hover:text-emerald-950' : 'hover:text-white'">Galeri</a>

        {{-- ✅ Member jadi halaman --}}
        <a href="{{ route('member') }}" class="{{ $navItem }}"
           :class="scrolled ? 'hover:text-emerald-950' : 'hover:text-white'">Member</a>

           <a href="{{ route('about') }}" class="{{ $navItem }}"
           :class="scrolled ? 'hover:text-emerald-950' : 'hover:text-white'">Tentang Kami</a>
      </nav>

      {{-- RIGHT: CTA + Mobile --}}
      <div
        class="flex items-center justify-end gap-2"
        x-data="{ openMobile:false, close(){ this.openMobile = false } }"
        @keydown.escape.window="close()"
        @click.outside="close()"
        @close-mobile-menu.window="openMobile=false"
      >
        <a
          href="{{ route('contact') }}"
          :class="scrolled ? 'bg-emerald-950 text-white hover:bg-emerald-900' : 'bg-white text-emerald-950 hover:bg-emerald-50'"
          class="hidden md:inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold transition-all duration-300 active:scale-[0.98]"
        >
          Hubungi Kami
        </a>

        <button
          type="button"
          @click="openMobile = !openMobile"
          :class="scrolled ? 'bg-emerald-950 text-white ring-emerald-900/10 hover:bg-emerald-900' : 'bg-white/10 text-white ring-white/20 hover:bg-white/15'"
          class="md:hidden inline-flex items-center justify-center rounded-xl px-3 py-2 ring-1 transition"
          aria-label="Toggle menu"
        >
          <span class="text-sm font-semibold">Menu</span>
        </button>

        {{-- Mobile dropdown --}}
        <div
          x-cloak
          x-show="openMobile"
          x-transition.opacity.scale.origin.top
          class="absolute right-0 top-full mt-3 w-64 overflow-hidden rounded-3xl bg-white/95 text-emerald-950 ring-1 ring-emerald-900/10 shadow-2xl backdrop-blur"
        >
          <div class="px-4 py-4 space-y-1 text-sm">
            <a @click="close()" class="block rounded-xl px-3 py-2 text-emerald-900 hover:bg-emerald-50 hover:text-emerald-950 transition" href="{{ route('home') }}">Beranda</a>
            <a @click="close()" class="block rounded-xl px-3 py-2 text-emerald-900 hover:bg-emerald-50 hover:text-emerald-950 transition" href="{{ route('services') }}">Layanan</a>
            <a @click="close()" class="block rounded-xl px-3 py-2 text-emerald-900 hover:bg-emerald-50 hover:text-emerald-950 transition" href="{{ route('portfolio') }}">Portofolio</a>
            <a @click="close()" class="block rounded-xl px-3 py-2 text-emerald-900 hover:bg-emerald-50 hover:text-emerald-950 transition" href="{{ route('gallery') }}">Galeri</a>


            {{-- ✅ Member mobile juga route --}}
            <a @click="close()" class="block rounded-xl px-3 py-2 text-emerald-900 hover:bg-emerald-50 hover:text-emerald-950 transition" href="{{ route('member') }}">Member</a>
            <a @click="close()" class="block rounded-xl px-3 py-2 text-emerald-900 hover:bg-emerald-50 hover:text-emerald-950 transition" href="{{ route('about') }}">Tentang Kami</a>
            <a
              @click="close()"
              class="mt-3 inline-flex w-full justify-center rounded-2xl bg-emerald-950 px-4 py-2.5 font-semibold text-white active:scale-[0.98]"
              href="{{ route('contact') }}"
            >
              Hubungi Kami
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>
