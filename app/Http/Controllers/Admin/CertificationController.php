<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends BaseAdminController
{
    public function index()
    {
        $items = Certification::orderBy('sort_order')->paginate(20);
        return view('admin.certifications.index', compact('items'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'issuer'     => 'nullable|string|max:255',
            'year'       => 'nullable|integer|min:1900|max:2100',
            'sort_order' => 'nullable|integer',
            'image'      => 'nullable|image|max:3072',
        ]);

        $imagePath = $this->uploadFile($request, 'image', 'certifications');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        Certification::create($data);

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Sertifikasi berhasil ditambahkan!');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'issuer'     => 'nullable|string|max:255',
            'year'       => 'nullable|integer|min:1900|max:2100',
            'sort_order' => 'nullable|integer',
            'image'      => 'nullable|image|max:3072',
        ]);

        $imagePath = $this->uploadFile($request, 'image', 'certifications', $certification->image);
        if ($imagePath) {
            $data['image'] = $imagePath;
        } else {
            unset($data['image']);
        }

        $certification->update($data);

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Sertifikasi berhasil diperbarui!');
    }

    public function destroy(Certification $certification)
    {
        $this->deleteFile($certification->image);
        $certification->delete();

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Sertifikasi berhasil dihapus!');
    }
}
