<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/member', [PageController::class, 'member'])->name('member');
Route::get('/member/{slug}', [PageController::class, 'memberDetail'])->name('member.detail');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/portofolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PageController::class, 'news'])->name('news');
Route::get('/hubungi-kami', [PageController::class, 'contact'])->name('contact');
Route::post('/contactsend', [ContactController::class, 'send'])->name('contact.send');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $sitemap = route('sitemap');
    $robots = <<<TXT
User-agent: *
Disallow: /admin
Disallow: /filament
Disallow: /dashboard
Disallow: /login
Disallow: /register
Allow: /

Sitemap: {$sitemap}
TXT;
    return response($robots, 200, ['Content-Type' => 'text/plain']);
});
