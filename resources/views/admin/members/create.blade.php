@extends('admin.layout')
@section('title','Tambah Anggota')
@section('page-title','Tambah Anggota')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Anggota</h2></div>
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Slug <span style="color:var(--text-muted);font-weight:400">(opsional, auto-generate)</span></label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="akan-dibuat-otomatis">
                @error('slug')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Posisi / Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" placeholder="Advokat Senior">
                @error('position')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="Partner, Associate, dll.">
                @error('category')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+62 ...">
                @error('phone')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@domain.com">
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/...">
                @error('linkedin')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
                @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Ringkasan Profil (Overview)</label>
                <textarea name="overview" class="form-control" rows="5" placeholder="Deskripsi singkat profil anggota...">{{ old('overview') }}</textarea>
                @error('overview')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Highlight Pengalaman <span style="color:var(--text-muted);font-weight:400">(1 item per baris)</span></label>
                <textarea name="experience_highlights" class="form-control" rows="5" placeholder="Menangani kasus arbitrase internasional&#10;Mitra di firma hukum terkemuka&#10;...">{{ old('experience_highlights') }}</textarea>
                <span class="form-hint">Satu highlight per baris</span>
                @error('experience_highlights')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Foto</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh" style="border-radius:50%">Foto</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none;border-radius:50%" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Upload foto anggota</div>
                        <div class="img-upload-hint">JPG, PNG, WEBP · Maks 3MB · Direkomendasikan: 400×400px</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="photo" class="hidden-file" accept="image/*">
                @error('photo')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Anggota</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
