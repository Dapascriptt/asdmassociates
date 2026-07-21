<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutController extends BaseAdminController
{
    public function edit()
    {
        $about = AboutContent::first() ?? new AboutContent();
        $about->about_images_text = $this->arrayToText($about->about_images);
        $about->hero_points_text  = $this->arrayToText($about->hero_points);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'intro_1'         => 'nullable|string',
            'intro_2'         => 'nullable|string',
            'hero_title'      => 'nullable|string|max:255',
            'hero_subtitle'   => 'nullable|string|max:500',
            'hero_points'     => 'nullable|string',
            'vision'          => 'nullable|string',
            'mission'         => 'nullable|string',
            'hero_image'      => 'nullable|image|max:3072',
            'about_images'    => 'nullable|array',
            'about_images.*'  => 'image|max:3072',
        ]);

        $about = AboutContent::first() ?? new AboutContent();

        $data['hero_points']  = $this->textToArray($request->input('hero_points'));
        $data['about_images'] = $about->about_images ?? [];

        // Hero image (single)
        $heroImagePath = $this->uploadFile($request, 'hero_image', 'about', $about->hero_image);
        if ($heroImagePath) {
            $data['hero_image'] = $heroImagePath;
        } else {
            unset($data['hero_image']);
        }

        // About images (multiple)
        if ($request->hasFile('about_images')) {
            $data['about_images'] = $this->uploadMultipleFiles(
                $request,
                'about_images',
                'about',
                $about->about_images ?? []
            );
        } else {
            unset($data['about_images']);
        }

        if ($about->exists) {
            $about->update($data);
        } else {
            AboutContent::create($data);
        }

        return redirect()->route('admin.about.edit')
            ->with('success', 'Konten Tentang berhasil disimpan!');
    }
}
