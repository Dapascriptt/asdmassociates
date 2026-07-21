@extends('admin.layout')
@section('title','Halaman Layanan')
@section('page-title','Konten Halaman Layanan')
@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Edit Halaman Layanan</h2>
        <p>Hero section untuk halaman /layanan</p>
    </div>
</div>
<div class="card">
    <form action="{{ route('admin.service-page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group">
                <label>Judul Hero</label>
                <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title',$content->hero_title) }}" placeholder="Layanan Kami">
            </div>
            <div class="form-group">
                <label>Subtitle Hero</label>
                <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle',$content->hero_subtitle) }}" placeholder="Sub judul...">
            </div>
            <div class="form-group span-2">
                <label>Poin-Poin Hero <span style="color:var(--text-muted);font-weight:400">(1 poin per baris)</span></label>
                <textarea name="hero_points" class="form-control" rows="5" placeholder="Layanan berkualitas tinggi&#10;Tim profesional&#10;...">{{ old('hero_points',$content->hero_points_text) }}</textarea>
                <span class="form-hint">Satu poin per baris</span>
            </div>
            <div class="form-group span-2">
                <label>Gambar Hero</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($content->hero_image)
                        <img src="{{ Storage::url($content->hero_image) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Upload</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $content->hero_image ? 'Ganti gambar hero' : 'Upload gambar hero' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="hero_image" class="hidden-file" accept="image/*">
                @error('hero_image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end">
            <button type="submit" class="btn btn-primary" style="min-width:140px">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.addEventListener('DOMContentLoaded',()=>setupImagePreview('imgIn','imgPrev'));</script>
@endpush
