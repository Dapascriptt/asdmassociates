@extends('admin.layout')
@section('title','Tambah Tim')
@section('page-title','Tambah Tim')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Anggota Tim</h2></div>
    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Posisi / Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" placeholder="Partner, Senior Associate, dll.">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
            </div>
            <div class="form-group span-2">
                <label>Bio / Deskripsi</label>
                <textarea name="bio" class="form-control" rows="4" placeholder="Biografi singkat...">{{ old('bio') }}</textarea>
            </div>
            <div class="form-group span-2">
                <label>Area Praktik <span style="color:var(--text-muted);font-weight:400">(1 item per baris)</span></label>
                <textarea name="practice_areas" class="form-control" rows="4" placeholder="Hukum Bisnis&#10;Hukum Perdata&#10;Arbitrase&#10;...">{{ old('practice_areas') }}</textarea>
                <span class="form-hint">Satu area per baris</span>
            </div>
            <div class="form-group span-2">
                <label>Foto</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh" style="border-radius:50%">Foto</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none;border-radius:50%" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Upload foto anggota tim</div>
                        <div class="img-upload-hint">JPG, PNG · Maks 3MB · Direkomendasikan: 400×400px</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="photo" class="hidden-file" accept="image/*">
                @error('photo')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
