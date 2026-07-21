@extends('admin.layout')
@section('title','Tambah Layanan')
@section('page-title','Tambah Layanan')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Layanan</h2></div>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Judul <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="category" class="form-control">
                    <option value="">— Pilih —</option>
                    <option value="utama" {{ old('category')=='utama'?'selected':'' }}>Utama</option>
                    <option value="pendukung" {{ old('category')=='pendukung'?'selected':'' }}>Pendukung</option>
                </select>
                @error('category')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Icon (nama/class)</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="cth: fa-briefcase">
                @error('icon')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
                @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi layanan...">{{ old('description') }}</textarea>
                @error('description')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Item Layanan <span style="color:var(--text-muted);font-weight:400">(1 item per baris)</span></label>
                <textarea name="items" class="form-control" rows="5" placeholder="Konsultasi Hukum&#10;Penyelesaian Sengketa&#10;...">{{ old('items') }}</textarea>
                <span class="form-hint">Satu item per baris — akan disimpan sebagai array</span>
                @error('items')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Gambar</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh">Upload</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Klik untuk upload gambar</div>
                        <div class="img-upload-hint">JPG, PNG, WEBP · Maks 3MB</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
