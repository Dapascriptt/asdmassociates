@extends('admin.layout')
@section('title', 'Tambah Mitra')
@section('page-title', 'Tambah Mitra')
@section('content')
    <div class="page-header">
        <div class="page-header-left">
            <h2>tambah Mitra</h2>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">&larr; Kembali</a>
    </div>
    <div class="card">
        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Nama Mitra <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                </div>
                <div class="form-group">
                    <label class="toggle-group">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active') ? 'checked' : 'checked' }}>
                        <span class="toggle-label">Aktif (tampil di website)</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="toggle-group">
                        <input type="checkbox" name="is_client" value="1" {{ old('is_client') ? 'checked' : '' }}>
                        <span class="toggle-label">Ini adalah Klien (bukan Mitra)</span>
                    </label>
                </div>
                <div class="form-group span-2">
                    <label>Logo</label>
                    <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                        <div class="img-upload-info">
                            <div class="img-upload-label">Upload logo mitra</div>
                            <div class="img-upload-hint">PNG transparan direkomendasikan · Maks 2MB</div>
                        </div>
                    </div>
                    <input type="file" id="imgIn" name="logo" class="hidden-file" accept="image/*">
                    @error('logo')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="divider"></div>
            <div style="display:flex;gap:10px;justify-content:flex-end">
                <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Mitra</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => setupImagePreview('imgIn', 'imgPrev'));
    </script>
@endpush
