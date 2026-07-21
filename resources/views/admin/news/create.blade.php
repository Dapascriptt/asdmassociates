@extends('admin.layout')
@section('title','Tambah Berita')
@section('page-title','Tambah Berita')
@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Tambah Berita</h2>
        <p>Isi form di bawah untuk menambah berita baru</p>
    </div>
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group span-2">
                <label for="title">Judul <span class="req">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="Judul berita..." required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="url">URL Berita</label>
                <input type="url" id="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="https://...">
                @error('url')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="site_name">Nama Sumber</label>
                <input type="text" id="site_name" name="site_name" class="form-control" value="{{ old('site_name') }}" placeholder="Kompas, CNN, dll.">
                @error('site_name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="published_at">Tanggal Publikasi</label>
                <input type="date" id="published_at" name="published_at" class="form-control" value="{{ old('published_at') }}">
                @error('published_at')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="sort_order">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
                @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label for="excerpt">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" class="form-control" rows="3" placeholder="Deskripsi singkat berita...">{{ old('excerpt') }}</textarea>
                @error('excerpt')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Gambar</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imageInput').click()">
                    <div class="img-preview-placeholder" id="imgPlaceholder">Upload</div>
                    <img src="" id="imgPreview" class="img-preview" style="display:none" alt="preview">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Klik untuk upload gambar</div>
                        <div class="img-upload-hint">JPG, PNG, WEBP · Maks 3MB</div>
                    </div>
                </div>
                <input type="file" id="imageInput" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Berita</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imageInput','imgPreview'));</script>
@endpush
