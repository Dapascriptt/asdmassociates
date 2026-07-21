@extends('admin.layout')
@section('title','Edit Tim')
@section('page-title','Edit Tim')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Anggota Tim</h2><p>{{ $team->name }}</p></div>
    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.team.update',$team) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name',$team->name) }}" required>
            </div>
            <div class="form-group">
                <label>Posisi / Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position',$team->position) }}">
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$team->sort_order) }}">
            </div>
            <div class="form-group span-2">
                <label>Bio / Deskripsi</label>
                <textarea name="bio" class="form-control" rows="4">{{ old('bio',$team->bio) }}</textarea>
            </div>
            <div class="form-group span-2">
                <label>Area Praktik <span style="color:var(--text-muted);font-weight:400">(1 item per baris)</span></label>
                <textarea name="practice_areas" class="form-control" rows="4">{{ old('practice_areas',$team->practice_areas_text) }}</textarea>
                <span class="form-hint">Satu area per baris</span>
            </div>
            <div class="form-group span-2">
                <label>Foto</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($team->photo)
                        <img src="{{ Storage::url($team->photo) }}" id="imgPrev" class="img-preview" style="border-radius:50%" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh" style="border-radius:50%">Foto</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none;border-radius:50%" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $team->photo ? 'Ganti foto' : 'Upload foto' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="photo" class="hidden-file" accept="image/*">
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
