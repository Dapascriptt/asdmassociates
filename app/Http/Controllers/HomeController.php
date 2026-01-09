<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $partners = Partner::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $galleries = Gallery::query()
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('partners', 'galleries'));
    }
}
