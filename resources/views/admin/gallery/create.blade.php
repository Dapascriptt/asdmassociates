@extends('admin.layout')
@section('title','Tambah Galeri')
@section('page-title','Tambah Galeri')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Tambah Galeri</h2></div>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid form-grid-2">
            <div class="form-group span-2">
                <label>Judul Album</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Nama album galeri...">
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Foto Cover Utama</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    <div class="img-preview-placeholder" id="imgPh">Cover</div>
                    <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    <div class="img-upload-info">
                        <div class="img-upload-label">Upload gambar cover</div>
                        <div class="img-upload-hint">JPG, PNG, WEBP &middot; Maks 3MB</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group span-2">
                <label>Foto Tambahan (Multiple)</label>
                <div style="border:1px dashed var(--border);border-radius:var(--radius);padding:16px;background:var(--bg-alt);text-align:center;cursor:pointer"
                     onclick="document.getElementById('imgsIn').click()">
                    <div style="font-size:.82rem;font-weight:500;color:var(--text)">Klik untuk pilih beberapa foto</div>
                    <div style="font-size:.72rem;color:var(--text-muted);margin-top:3px">Pilih banyak file sekaligus</div>
                </div>
                <input type="file" id="imgsIn" name="images[]" class="hidden-file" accept="image/*" multiple>
                <div id="multiPreview" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:10px"></div>
                @error('images')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Galeri</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    setupImagePreview('imgIn', 'imgPrev');
    document.getElementById('imgsIn').addEventListener('change', function() {
        const container = document.getElementById('multiPreview');
        container.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style = 'width:70px;height:70px;object-fit:cover;border-radius:6px;border:1px solid var(--border)';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endpush
