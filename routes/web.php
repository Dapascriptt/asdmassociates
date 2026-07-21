<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\ServicePageContentController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;

// ─── Frontend Routes (unchanged) ─────────────────────────────────────────────
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

// ─── Admin CMS Routes ─────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Public: login / logout
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('admin.auth')->name('logout');

    // Protected: everything inside requires admin.auth
    Route::middleware('admin.auth')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD resources
        Route::resource('news',           NewsController::class);
        Route::resource('services',       ServiceController::class);
        Route::resource('members',        MemberController::class);
        Route::resource('partners',       PartnerController::class);
        Route::resource('gallery',        GalleryController::class);
        Route::resource('certifications', CertificationController::class);
        Route::resource('team',           TeamMemberController::class);
        Route::resource('portfolio',      PortfolioController::class);
        Route::resource('clients',        ClientController::class);

        // Singleton pages (no list/create/destroy — just edit & update)
        Route::get('about',        [AboutController::class, 'edit'])->name('about.edit');
        Route::put('about',        [AboutController::class, 'update'])->name('about.update');

        Route::get('contact-settings', [ContactSettingController::class, 'edit'])->name('contact.edit');
        Route::put('contact-settings', [ContactSettingController::class, 'update'])->name('contact.update');

        Route::get('service-page', [ServicePageContentController::class, 'edit'])->name('service-page.edit');
        Route::put('service-page', [ServicePageContentController::class, 'update'])->name('service-page.update');
    });
});

