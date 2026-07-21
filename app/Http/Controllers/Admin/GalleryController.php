<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends BaseAdminController
{
    public function index()
    {
        $items = Gallery::latest()->paginate(15);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:3072',
            'images'   => 'nullable|array',
            'images.*' => 'image|max:3072',
        ]);

        $coverPath = $this->uploadFile($request, 'image', 'gallery');
        if ($coverPath) {
            $data['image'] = $coverPath;
        }

        if ($request->hasFile('images')) {
            $data['images'] = $this->uploadMultipleFiles($request, 'images', 'gallery');
        } else {
            $data['images'] = [];
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title'    => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:3072',
            'images'   => 'nullable|array',
            'images.*' => 'image|max:3072',
        ]);

        $coverPath = $this->uploadFile($request, 'image', 'gallery', $gallery->image);
        if ($coverPath) {
            $data['image'] = $coverPath;
        } else {
            unset($data['image']);
        }

        if ($request->hasFile('images')) {
            $data['images'] = $this->uploadMultipleFiles($request, 'images', 'gallery', $gallery->images ?? []);
        } else {
            unset($data['images']);
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        $this->deleteFile($gallery->image);
        foreach ($gallery->images ?? [] as $img) {
            $this->deleteFile($img);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil dihapus!');
    }
}
