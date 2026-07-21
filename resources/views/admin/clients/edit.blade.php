@extends('admin.layout')
@section('title','Edit Klien')
@section('page-title','Edit Klien')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Klien</h2><p>{{ $client->name }}</p></div>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.clients.update',$client) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Nama Klien <span class="req">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name',$client->name) }}" required>
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$client->sort_order) }}">
            </div>
            <div class="form-group span-2">
                <label>Logo</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($client->logo)
                        <img src="{{ Storage::url($client->logo) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $client->logo ? 'Ganti logo' : 'Upload logo' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="logo" class="hidden-file" accept="image/*">
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Klien</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
