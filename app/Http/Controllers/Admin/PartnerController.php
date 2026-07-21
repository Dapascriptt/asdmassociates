<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends BaseAdminController
{
    public function index()
    {
        $items = Partner::orderBy('order')->paginate(20);
        return view('admin.partners.index', compact('items'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|max:2048',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'is_client' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['is_client'] = $request->boolean('is_client');

        $logoPath = $this->uploadFile($request, 'logo', 'partners');
        if ($logoPath) {
            $data['logo'] = $logoPath;
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra berhasil ditambahkan!');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|max:2048',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'is_client' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['is_client'] = $request->boolean('is_client');

        $logoPath = $this->uploadFile($request, 'logo', 'partners', $partner->logo);
        if ($logoPath) {
            $data['logo'] = $logoPath;
        } else {
            unset($data['logo']);
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra berhasil diperbarui!');
    }

    public function destroy(Partner $partner)
    {
        $this->deleteFile($partner->logo);
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra berhasil dihapus!');
    }
}
