@extends('admin.layout')
@section('title','Edit Sertifikasi')
@section('page-title','Edit Sertifikasi')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Sertifikasi</h2><p>{{ $certification->title }}</p></div>
    <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.certifications.update',$certification) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Judul Sertifikasi <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title',$certification->title) }}" required>
            </div>
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="issuer" class="form-control" value="{{ old('issuer',$certification->issuer) }}">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ old('year',$certification->year) }}" min="1900" max="2100">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$certification->sort_order) }}">
            </div>
            <div class="form-group span-2">
                <label>Gambar Sertifikat</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($certification->image)
                        <img src="{{ Storage::url($certification->image) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $certification->image ? 'Ganti gambar' : 'Upload gambar' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="image" class="hidden-file" accept="image/*">
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Sertifikasi</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
