@extends('admin.layout')
@section('title','Edit Galeri')
@section('page-title','Edit Galeri')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Edit Galeri</h2><p>{{ $gallery->title ?? 'Album' }}</p></div>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
<div class="card">
    <form action="{{ route('admin.gallery.update',$gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid form-grid-2">
            <div class="form-group span-2">
                <label>Judul Album</label>
                <input type="text" name="title" class="form-control" value="{{ old('title',$gallery->title) }}">
            </div>
            <div class="form-group span-2">
                <label>Foto Cover Utama</label>
                <div class="img-upload-wrap" onclick="document.getElementById('imgIn').click()">
                    @if($gallery->image)
                        <img src="{{ Storage::url($gallery->image) }}" id="imgPrev" class="img-preview" alt="">
                    @else
                        <div class="img-preview-placeholder" id="imgPh">Cover</div>
                        <img src="" id="imgPrev" class="img-preview" style="display:none" alt="">
                    @endif
                    <div class="img-upload-info">
                        <div class="img-upload-label">{{ $gallery->image ? 'Ganti cover' : 'Upload cover' }}</div>
                        <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                    </div>
                </div>
                <input type="file" id="imgIn" name="image" class="hidden-file" accept="image/*">
                @error('image')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            @if($gallery->images && count($gallery->images))
            <div class="form-group span-2">
                <label>Foto Saat Ini</label>
                <div style="display:flex;flex-wrap:wrap;gap:8px">
                    @foreach($gallery->images as $img)
                    <img src="{{ Storage::url($img) }}" loading="lazy" alt=""
                         style="width:80px;height:80px;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
                    @endforeach
                </div>
                <span class="form-hint">Upload foto baru akan menggantikan semua foto di atas</span>
            </div>
            @endif
            <div class="form-group span-2">
                <label>Upload Foto Baru (Multiple)</label>
                <div style="border:1px dashed var(--border);border-radius:var(--radius);padding:16px;background:var(--bg-alt);text-align:center;cursor:pointer"
                     onclick="document.getElementById('imgsIn').click()">
                    <div style="font-size:.82rem;font-weight:500;color:var(--text)">Pilih beberapa foto baru</div>
                    <div style="font-size:.72rem;color:var(--text-muted);margin-top:3px">Akan menggantikan foto-foto sebelumnya</div>
                </div>
                <input type="file" id="imgsIn" name="images[]" class="hidden-file" accept="image/*" multiple>
                <div id="multiPreview" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:10px"></div>
                @error('images')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="divider"></div>
        <div style="display:flex;gap:10px;justify-content:flex-end">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui Galeri</button>
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
