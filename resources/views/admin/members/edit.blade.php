@extends('admin.layout')
@section('title','Edit Anggota')
@section('page-title','Edit Anggota')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Anggota</h2><p>{{ $member->name }}</p></div>
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.members.update',$member) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name',$member->name) }}" required>
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug',$member->slug) }}">
                @error('slug')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Posisi / Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position',$member->position) }}">
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" class="form-control" value="{{ old('category',$member->category) }}">
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone',$member->phone) }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email',$member->email) }}">
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin',$member->linkedin) }}">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$member->sort_order) }}">
            </div>
            <div class="form-group span-2">
                <label>Ringkasan Profil (Overview)</label>
                <textarea name="overview" class="form-control" rows="5">{{ old('overview',$member->overview) }}</textarea>
            </div>
            <div class="form-group span-2">
                <label>Highlight Pengalaman <span style="color:var(--text-muted);font-weight:400">(1 item per baris)</span></label>
                <textarea name="experience_highlights" class="form-control" rows="5">{{ old('experience_highlights',$member->experience_highlights_text) }}</textarea>
                <span class="form-hint">Satu highlight per baris</span>
            </div>
            <div class="form-group span-2">
                <label>Foto</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($member->photo)
                        <img src="{{ Storage::url($member->photo) }}" id="imgPrev" class="img-preview" style="border-radius:50%" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh" style="border-radius:50%">Foto</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none;border-radius:50%" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $member->photo ? 'Ganti foto' : 'Upload foto' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="photo" class="hidden-file" accept="image/*">
                @error('photo')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Anggota</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
