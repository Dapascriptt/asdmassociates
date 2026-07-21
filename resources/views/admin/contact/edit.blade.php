@extends('admin.layout')
@section('title','Pengaturan Kontak')
@section('page-title','Pengaturan Kontak')
@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Edit Pengaturan Kontak</h2>
        <p>Informasi yang tampil di halaman /hubungi-kami</p>
    </div>
</div>
<div class="card">
    <form action="{{ route('admin.contact.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Judul Hero</label>
                <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title',$contact->hero_title) }}" placeholder="Hubungi Kami">
            </div>
            <div class="form-group">
                <label>Subtitle Hero</label>
                <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle',$contact->hero_subtitle) }}" placeholder="Sub judul halaman kontak...">
            </div>
            <div class="form-group">
                <label>Telepon Utama</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone',$contact->phone) }}" placeholder="+62 21 XXX XXXX">
                @error('phone')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Email Utama</label>
                <input type="email" name="email" class="form-control" value="{{ old('email',$contact->email) }}" placeholder="info@asdmassociates.com">
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Email Alternatif</label>
                <input type="email" name="email_alt" class="form-control" value="{{ old('email_alt',$contact->email_alt) }}" placeholder="contact@asdm...">
                @error('email_alt')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Jam Kerja</label>
                <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours',$contact->working_hours) }}" placeholder="Senin–Jumat, 09.00–17.00 WIB">
            </div>
            <div class="form-group span-2">
                <label>Alamat</label>
                <textarea name="address" class="form-control" rows="3" placeholder="Alamat kantor lengkap...">{{ old('address',$contact->address) }}</textarea>
            </div>
            <div class="form-group span-2">
                <label>Embed Google Maps <span style="color:var(--text-muted);font-weight:400">(iframe HTML)</span></label>
                <textarea name="map_embed" class="form-control" rows="4" placeholder='&lt;iframe src="https://maps.google.com/..." ...&gt;&lt;/iframe&gt;'>{{ old('map_embed',$contact->map_embed) }}</textarea>
                <span class="form-hint">Paste kode iframe dari Google Maps. Buka Google Maps → Share → Embed a map → Copy HTML</span>
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end">
            <button type="submit" class="btn btn-primary" style="min-width:140px">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
