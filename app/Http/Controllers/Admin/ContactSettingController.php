<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends BaseAdminController
{
    public function edit()
    {
        $contact = ContactSetting::first() ?? new ContactSetting();
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title'    => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'phone'         => 'nullable|string|max:50',
            'email'         => 'nullable|email|max:255',
            'email_alt'     => 'nullable|email|max:255',
            'address'       => 'nullable|string',
            'working_hours' => 'nullable|string|max:255',
            'map_embed'     => 'nullable|string',
        ]);

        $contact = ContactSetting::first() ?? new ContactSetting();

        if ($contact->exists) {
            $contact->update($data);
        } else {
            ContactSetting::create($data);
        }

        return redirect()->route('admin.contact.edit')
            ->with('success', 'Pengaturan kontak berhasil disimpan!');
    }
}
