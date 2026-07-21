@extends('admin.layout')
@section('title','Tambah Portofolio')
@section('page-title','Tambah Portofolio')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Portofolio</h2></div>
    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama Perusahaan <span class="req">*</span></label>
                <input type="text" name="company" class="form-control" value="{{ old('company') }}" required>
                @error('company')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Peran / Posisi</label>
                <input type="text" name="role" class="form-control" value="{{ old('role') }}" placeholder="Lead Counsel, Advisor, dll.">
            </div>
            <div class="form-group">
                <label>Periode</label>
                <input type="text" name="period" class="form-control" value="{{ old('period') }}" placeholder="2020–2022">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
            </div>
            <div class="form-group span-2">
                <label>Logo Perusahaan</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh">Upload</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Upload logo perusahaan</div>
                        <div class="img-upload-hint">PNG transparan direkomendasikan · Maks 2MB</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="logo" class="hidden-file" accept="image/*">
                @error('logo')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Portofolio</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
