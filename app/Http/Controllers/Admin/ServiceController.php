<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends BaseAdminController
{
    public function index()
    {
        $items = Service::orderBy('sort_order')->paginate(15);
        return view('admin.services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|in:utama,pendukung',
            'items'       => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:3072',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['items'] = $this->textToArray($request->input('items'));

        $imagePath = $this->uploadFile($request, 'image', 'services');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Service $service)
    {
        $service->items_text = $this->arrayToText($service->items);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|in:utama,pendukung',
            'items'       => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|max:3072',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['items'] = $this->textToArray($request->input('items'));

        $imagePath = $this->uploadFile($request, 'image', 'services', $service->image);
        if ($imagePath) {
            $data['image'] = $imagePath;
        } else {
            unset($data['image']);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $this->deleteFile($service->image);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
