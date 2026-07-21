@extends('admin.layout')
@section('title','Tambah Klien')
@section('page-title','Tambah Klien')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Klien</h2></div>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama Klien <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}">
            </div>
            <div class="form-group span-2">
                <label>Logo</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh">Upload</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Upload logo klien</div>
                        <div class="img-upload-hint">PNG transparan direkomendasikan · Maks 2MB</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="logo" class="hidden-file" accept="image/*">
                @error('logo')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Klien</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
