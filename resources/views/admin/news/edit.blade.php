@extends('admin.layout')
@section('title','Edit Berita')
@section('page-title','Edit Berita')
@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Edit Berita</h2>
        <p>{{ Str::limit($news->title,50) }}</p>
    </div>
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.news.update',$news) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group span-2">
                <label for="title">Judul <span class="req">*</span></label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title',$news->title) }}" required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="url">URL Berita</label>
                <input type="url" id="url" name="url" class="form-control" value="{{ old('url',$news->url) }}" placeholder="https://...">
                @error('url')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="site_name">Nama Sumber</label>
                <input type="text" id="site_name" name="site_name" class="form-control" value="{{ old('site_name',$news->site_name) }}">
                @error('site_name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="published_at">Tanggal Publikasi</label>
                <input type="date" id="published_at" name="published_at" class="form-control" value="{{ old('published_at',$news->published_at?->format('Y-m-d')) }}">
                @error('published_at')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="sort_order">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order',$news->sort_order) }}">
                @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label for="excerpt">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" class="form-control" rows="3">{{ old('excerpt',$news->excerpt) }}</textarea>
                @error('excerpt')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Gambar</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imageInput').click()">
                    @if($news->image)
                        <img src="{{ Storage::url($news->image) }}" id="imgPreview" class="img-preview" alt="current">
                    @else
                        <div class="img-preview-placeholder" id="imgPlaceholder">Upload</div>
                        <img src="" id="imgPreview" class="img-preview" style="display:none" alt="preview">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $news->image ? 'Ganti gambar' : 'Klik untuk upload gambar' }}</div>
                        <div class="img-upload-hint">JPG, PNG, WEBP · Maks 3MB · Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imageInput" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Berita</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imageInput','imgPreview'));</script>
@endpush
