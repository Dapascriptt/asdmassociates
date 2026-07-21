<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends BaseAdminController
{
    public function index()
    {
        $items = TeamMember::orderBy('sort_order')->paginate(20);
        return view('admin.team.index', compact('items'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'position'       => 'nullable|string|max:255',
            'bio'            => 'nullable|string',
            'photo'          => 'nullable|image|max:3072',
            'practice_areas' => 'nullable|string',
            'sort_order'     => 'nullable|integer',
        ]);

        $data['practice_areas'] = $this->textToArray($request->input('practice_areas'));

        $photoPath = $this->uploadFile($request, 'photo', 'team');
        if ($photoPath) {
            $data['photo'] = $photoPath;
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function edit(TeamMember $team)
    {
        $team->practice_areas_text = $this->arrayToText($team->practice_areas);
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'position'       => 'nullable|string|max:255',
            'bio'            => 'nullable|string',
            'photo'          => 'nullable|image|max:3072',
            'practice_areas' => 'nullable|string',
            'sort_order'     => 'nullable|integer',
        ]);

        $data['practice_areas'] = $this->textToArray($request->input('practice_areas'));

        $photoPath = $this->uploadFile($request, 'photo', 'team', $team->photo);
        if ($photoPath) {
            $data['photo'] = $photoPath;
        } else {
            unset($data['photo']);
        }

        $team->update($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil diperbarui!');
    }

    public function destroy(TeamMember $team)
    {
        $this->deleteFile($team->photo);
        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil dihapus!');
    }
}
