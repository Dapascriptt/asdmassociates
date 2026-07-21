@extends('admin.layout')
@section('title','Edit Mitra')
@section('page-title','Edit Mitra')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Mitra</h2><p>{{ $partner->name }}</p></div>
    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.partners.update',$partner) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama Mitra <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name',$partner->name) }}" required>
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="order" class="form-control" value="{{ old('order',$partner->order) }}">
            </div>
            <div class="form-group">
                <label class="toggle-group">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                    <span class="toggle-label">Aktif</span>
                </label>
            </div>
            <div class="form-group">
                <label class="toggle-group">
                    <input type="checkbox" name="is_client" value="1" {{ old('is_client', $partner->is_client) ? 'checked' : '' }}>
                    <span class="toggle-label">Ini adalah Klien</span>
                </label>
            </div>
            <div class="form-group span-2">
                <label>Logo</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($partner->logo)
                        <img src="{{ Storage::url($partner->logo) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $partner->logo ? 'Ganti logo' : 'Upload logo' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="logo" class="hidden-file" accept="image/*">
                @error('logo')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Mitra</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
