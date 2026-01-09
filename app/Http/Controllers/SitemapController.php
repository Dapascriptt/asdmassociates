<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            ['loc' => route('home')],
            ['loc' => route('about')],
            ['loc' => route('member')],
            ['loc' => route('services')],
            ['loc' => route('portfolio')],
            ['loc' => route('gallery')],
            ['loc' => route('news')],
            ['loc' => route('contact')],
        ];

        // Dynamic: member detail
        foreach (Member::select('slug', 'updated_at')->orderBy('updated_at', 'desc')->get() as $member) {
            $urls[] = [
                'loc' => route('member.detail', $member->slug),
                'lastmod' => optional($member->updated_at)->toAtomString(),
            ];
        }

        // Dynamic: layanan (gunakan halaman layanan utama saja)
        foreach (Service::select('id', 'updated_at')->orderBy('updated_at', 'desc')->get() as $service) {
            $urls[] = [
                'loc' => route('services'),
                'lastmod' => optional($service->updated_at)->toAtomString(),
            ];
        }

        // Hilangkan duplikat berdasarkan loc
        $urls = collect($urls)
            ->filter(fn ($item) => !empty($item['loc']))
            ->unique('loc')
            ->values()
            ->all();

        // Render view dan tambahkan XML declaration
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= view('pages.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}
