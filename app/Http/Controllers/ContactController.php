<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $to = config('mail.from.address', 'saridamayantilawoffice@gmail.com');

        $body = "Pesan masuk dari formulir kontak ASDM Associates:\n\n"
              . "Nama: {$data['name']}\n"
              . "Email: {$data['email']}\n"
              . "Telepon: " . ($data['phone'] ?? '-') . "\n"
              . "Perusahaan: " . ($data['company'] ?? '-') . "\n"
              . "Perihal: " . ($data['subject'] ?? '-') . "\n\n"
              . "Pesan:\n{$data['message']}";

        try {
            Mail::raw($body, function ($mail) use ($to) {
                $mail->to($to)->subject('Pesan baru dari Form Kontak ASDM Associates');
            });
            return back()->with('status', 'Pesan terkirim. Terima kasih telah menghubungi kami.');
        } catch (\Throwable $e) {
            return back()->with('status', 'Terjadi kendala saat mengirim pesan. Silakan coba lagi atau hubungi via email.');
        }
    }
}
