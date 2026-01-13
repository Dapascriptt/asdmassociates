<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutContent;
use App\Models\Certification;
use App\Models\TeamMember;
use App\Models\Member;
use App\Models\ContactSetting;
use App\Models\PortfolioItem;
use App\Models\Partner;
class PageController extends Controller
{
    public function home() {
        $news = \App\Models\News::orderBy('sort_order')
            ->orderByDesc('published_at')
            ->take(4)
            ->get();
        $partners = \App\Models\Partner::where('is_active', true)->where('is_client', false)->orderBy('order')->get();
        $clients = \App\Models\Partner::where('is_active', true)->where('is_client', true)->orderBy('order')->get();
        $galleries = \App\Models\Gallery::latest()->take(6)->get();
        $memberCount = Member::count();
        $caseCount = PortfolioItem::count();

        // gunakan view utama (resources/views/home.blade.php)
        return view('home', compact('news', 'partners', 'clients', 'galleries', 'memberCount', 'caseCount'));
    }

    public function about()
{
    $about = \App\Models\AboutContent::first();

    $certs = \App\Models\Certification::orderBy('sort_order')->get();
    $teams = \App\Models\TeamMember::orderBy('sort_order')->get();

    return view('pages.about', compact('about', 'certs', 'teams'));
}

    public function services() {
        $services = \App\Models\Service::orderBy('sort_order')->get();
        $serviceContent = \App\Models\ServicePageContent::first();

        $main = $services->where('category', 'utama');
        $extra = $services->where('category', 'pendukung');

        // Kalau kategori belum diisi, pakai semua sebagai main
        if ($main->isEmpty()) {
            $main = $services;
        }

        return view('pages.services', [
            'servicesMain' => $main,
            'servicesExtra' => $extra,
            'allServices' => $services,
            'serviceContent' => $serviceContent,
        ]);
    }

    public function portfolio() {
        $portfolioItems = PortfolioItem::orderBy('sort_order')->get();
        $partners = Partner::where('is_active', true)->where('is_client', false)->orderBy('order')->get();
        $clients = Partner::where('is_active', true)->where('is_client', true)->orderBy('order')->get();
        return view('pages.portofolio', compact('portfolioItems', 'partners', 'clients'));
    }

    public function gallery() {
        $galleries = \App\Models\Gallery::latest()->get();
        return view('pages.gallery', compact('galleries'));
    }

    public function member() {
        $members = Member::orderBy('sort_order')->get();
        return view('pages.member', compact('members'));
    }

    public function memberDetail(string $slug) {
        $member = Member::where('slug', $slug)->firstOrFail();
        return view('pages.detail-member', compact('member'));
    }

    public function news() {
        return view('pages.news');
    }

    public function contact() {
        $contact = ContactSetting::first();
        return view('pages.contact', compact('contact'));
    }

}
