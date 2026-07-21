@extends('admin.layout')
@section('title','Edit Portofolio')
@section('page-title','Edit Portofolio')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Portofolio</h2><p>{{ $portfolio->company }}</p></div>
    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.portfolio.update',$portfolio) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama Perusahaan <span class="req">*</span></label>
                <input type="text" name="company" class="form-control" value="{{ old('company',$portfolio->company) }}" required>
            </div>
            <div class="form-group">
                <label>Peran / Posisi</label>
                <input type="text" name="role" class="form-control" value="{{ old('role',$portfolio->role) }}">
            </div>
            <div class="form-group">
                <label>Periode</label>
                <input type="text" name="period" class="form-control" value="{{ old('period',$portfolio->period) }}">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$portfolio->sort_order) }}">
            </div>
            <div class="form-group span-2">
                <label>Logo Perusahaan</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($portfolio->logo)
                        <img src="{{ Storage::url($portfolio->logo) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $portfolio->logo ? 'Ganti logo' : 'Upload logo' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="logo" class="hidden-file" accept="image/*">
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Portofolio</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
