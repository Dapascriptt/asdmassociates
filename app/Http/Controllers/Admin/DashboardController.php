<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Service;
use App\Models\Member;
use App\Models\Partner;
use App\Models\Gallery;
use App\Models\PortfolioItem;
use App\Models\Certification;
use App\Models\TeamMember;
use App\Models\Client;

class DashboardController extends BaseAdminController
{
    public function index()
    {
        $stats = [
            'news'           => News::count(),
            'services'       => Service::count(),
            'members'        => Member::count(),
            'partners'       => Partner::where('is_client', false)->count(),
            'clients'        => Partner::where('is_client', true)->count(),
            'gallery'        => Gallery::count(),
            'portfolio'      => PortfolioItem::count(),
            'certifications' => Certification::count(),
            'team'           => TeamMember::count(),
        ];

        $latestNews = News::orderByDesc('published_at')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'latestNews'));
    }
}
