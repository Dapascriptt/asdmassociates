@extends('admin.layout')
@section('title','Edit Layanan')
@section('page-title','Edit Layanan')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Layanan</h2><p>{{ $service->title }}</p></div>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.services.update',$service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Judul <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title',$service->title) }}" required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="category" class="form-control">
                    <option value="">— Pilih —</option>
                    <option value="utama" {{ old('category',$service->category)=='utama'?'selected':'' }}>Utama</option>
                    <option value="pendukung" {{ old('category',$service->category)=='pendukung'?'selected':'' }}>Pendukung</option>
                </select>
            </div>
            <div class="form-group">
                <label>Icon</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon',$service->icon) }}">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$service->sort_order) }}">
            </div>
            <div class="form-group span-2">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description',$service->description) }}</textarea>
            </div>
            <div class="form-group span-2">
                <label>Item Layanan <span style="color:var(--text-muted);font-weight:400">(1 item per baris)</span></label>
                <textarea name="items" class="form-control" rows="5">{{ old('items',$service->items_text) }}</textarea>
                <span class="form-hint">Satu item per baris</span>
            </div>
            <div class="form-group span-2">
                <label>Gambar</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $service->image ? 'Ganti gambar' : 'Upload gambar' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Layanan</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
