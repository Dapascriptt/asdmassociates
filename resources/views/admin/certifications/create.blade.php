@extends('admin.layout')
@section('title','Tambah Sertifikasi')
@section('page-title','Tambah Sertifikasi')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Sertifikasi</h2></div>
    <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Judul Sertifikasi <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Penerbit (Issuer)</label>
                <input type="text" name="issuer" class="form-control" value="{{ old('issuer') }}" placeholder="Lembaga / Organisasi penerbit">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', date('Y')) }}" min="1900" max="2100">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
            </div>
            <div class="form-group span-2">
                <label>Gambar Sertifikat</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh">Upload</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Upload gambar sertifikat</div>
                        <div class="img-upload-hint">JPG, PNG, WEBP · Maks 3MB</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Sertifikasi</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
