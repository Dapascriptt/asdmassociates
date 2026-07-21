<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends BaseAdminController
{
    public function index()
    {
        $items = Client::orderBy('sort_order')->paginate(20);
        return view('admin.clients.index', compact('items'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $logoPath = $this->uploadFile($request, 'logo', 'clients');
        if ($logoPath) {
            $data['logo'] = $logoPath;
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Klien berhasil ditambahkan!');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $logoPath = $this->uploadFile($request, 'logo', 'clients', $client->logo);
        if ($logoPath) {
            $data['logo'] = $logoPath;
        } else {
            unset($data['logo']);
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Klien berhasil diperbarui!');
    }

    public function destroy(Client $client)
    {
        $this->deleteFile($client->logo);
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Klien berhasil dihapus!');
    }
}
