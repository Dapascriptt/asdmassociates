<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends BaseAdminController
{
    public function index()
    {
        $items = Member::orderBy('sort_order')->paginate(15);
        return view('admin.members.index', compact('items'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                   => 'required|string|max:255',
            'slug'                   => 'nullable|string|max:255|unique:members,slug',
            'category'               => 'nullable|string|max:255',
            'position'               => 'nullable|string|max:255',
            'phone'                  => 'nullable|string|max:50',
            'email'                  => 'nullable|email|max:255',
            'linkedin'               => 'nullable|url|max:500',
            'photo'                  => 'nullable|image|max:3072',
            'overview'               => 'nullable|string',
            'experience_highlights'  => 'nullable|string',
            'sort_order'             => 'nullable|integer',
        ]);

        // Auto-generate slug if not provided
        $data['slug'] = !empty($data['slug'])
            ? Str::slug($data['slug'])
            : Str::slug($data['name']);

        $data['experience_highlights'] = $this->textToArray($request->input('experience_highlights'));

        $photoPath = $this->uploadFile($request, 'photo', 'members');
        if ($photoPath) {
            $data['photo'] = $photoPath;
        }

        Member::create($data);

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        $member->experience_highlights_text = $this->arrayToText($member->experience_highlights);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'slug'                  => 'nullable|string|max:255|unique:members,slug,' . $member->id,
            'category'              => 'nullable|string|max:255',
            'position'              => 'nullable|string|max:255',
            'phone'                 => 'nullable|string|max:50',
            'email'                 => 'nullable|email|max:255',
            'linkedin'              => 'nullable|url|max:500',
            'photo'                 => 'nullable|image|max:3072',
            'overview'              => 'nullable|string',
            'experience_highlights' => 'nullable|string',
            'sort_order'            => 'nullable|integer',
        ]);

        $data['slug'] = !empty($data['slug'])
            ? Str::slug($data['slug'])
            : Str::slug($data['name']);

        $data['experience_highlights'] = $this->textToArray($request->input('experience_highlights'));

        $photoPath = $this->uploadFile($request, 'photo', 'members', $member->photo);
        if ($photoPath) {
            $data['photo'] = $photoPath;
        } else {
            unset($data['photo']);
        }

        $member->update($data);

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        $this->deleteFile($member->photo);
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
