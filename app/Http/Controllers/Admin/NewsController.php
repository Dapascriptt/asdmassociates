<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends BaseAdminController
{
    public function index()
    {
        $items = News::orderBy('sort_order')
            ->orderByDesc('published_at')
            ->paginate(15);

        return view('admin.news.index', compact('items'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'url'          => 'nullable|url|max:500',
            'excerpt'      => 'nullable|string',
            'site_name'    => 'nullable|string|max:255',
            'image'        => 'nullable|image|max:3072',
            'published_at' => 'nullable|date',
            'sort_order'   => 'nullable|integer',
        ]);

        $imagePath = $this->uploadFile($request, 'image', 'news');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'url'          => 'nullable|url|max:500',
            'excerpt'      => 'nullable|string',
            'site_name'    => 'nullable|string|max:255',
            'image'        => 'nullable|image|max:3072',
            'published_at' => 'nullable|date',
            'sort_order'   => 'nullable|integer',
        ]);

        $imagePath = $this->uploadFile($request, 'image', 'news', $news->image);
        if ($imagePath) {
            $data['image'] = $imagePath;
        } else {
            unset($data['image']);
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        $this->deleteFile($news->image);
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
