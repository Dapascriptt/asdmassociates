<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends BaseAdminController
{
    public function index()
    {
        $items = PortfolioItem::orderBy('sort_order')->paginate(20);
        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role'       => 'nullable|string|max:255',
            'period'     => 'nullable|string|max:100',
            'company'    => 'required|string|max:255',
            'logo'       => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $logoPath = $this->uploadFile($request, 'logo', 'portfolio');
        if ($logoPath) {
            $data['logo'] = $logoPath;
        }

        PortfolioItem::create($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit(PortfolioItem $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $data = $request->validate([
            'role'       => 'nullable|string|max:255',
            'period'     => 'nullable|string|max:100',
            'company'    => 'required|string|max:255',
            'logo'       => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $logoPath = $this->uploadFile($request, 'logo', 'portfolio', $portfolio->logo);
        if ($logoPath) {
            $data['logo'] = $logoPath;
        } else {
            unset($data['logo']);
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy(PortfolioItem $portfolio)
    {
        $this->deleteFile($portfolio->logo);
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portofolio berhasil dihapus!');
    }
}
