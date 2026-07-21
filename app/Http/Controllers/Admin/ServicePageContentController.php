<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServicePageContent;
use Illuminate\Http\Request;

class ServicePageContentController extends BaseAdminController
{
    public function edit()
    {
        $content = ServicePageContent::first() ?? new ServicePageContent();
        $content->hero_points_text = $this->arrayToText($content->hero_points);
        return view('admin.service-page.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title'    => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_image'    => 'nullable|image|max:3072',
            'hero_points'   => 'nullable|string',
        ]);

        $content = ServicePageContent::first() ?? new ServicePageContent();

        $data['hero_points'] = $this->textToArray($request->input('hero_points'));

        $imagePath = $this->uploadFile($request, 'hero_image', 'service-page', $content->hero_image);
        if ($imagePath) {
            $data['hero_image'] = $imagePath;
        } else {
            unset($data['hero_image']);
        }

        if ($content->exists) {
            $content->update($data);
        } else {
            ServicePageContent::create($data);
        }

        return redirect()->route('admin.service-page.edit')
            ->with('success', 'Konten halaman layanan berhasil disimpan!');
    }
}
