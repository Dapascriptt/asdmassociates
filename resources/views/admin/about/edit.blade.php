@extends('admin.layout')
@section('title','Konten Tentang')
@section('page-title','Halaman Tentang')
@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Edit Konten Tentang</h2>
        <p>Isi konten untuk halaman /tentang</p>
    </div>
</div>
<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">

        {{-- Hero Section --}}
        <div class="card" style="grid-column:1/-1">
            <div class="card-header"><div class="card-title">Hero Section</div></div>
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label>Judul Hero</label>
                    <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title',$about->hero_title) }}" placeholder="Tentang ASDM Associates">
                </div>
                <div class="form-group">
                    <label>Subtitle Hero</label>
                    <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle',$about->hero_subtitle) }}" placeholder="Sub judul...">
                </div>
                <div class="form-group span-2">
                    <label>Poin-Poin Hero <span style="color:var(--text-muted);font-weight:400">(1 poin per baris)</span></label>
                    <textarea name="hero_points" class="form-control" rows="4" placeholder="Pengalaman lebih dari 20 tahun&#10;Tim profesional berpengalaman&#10;...">{{ old('hero_points',$about->hero_points_text) }}</textarea>
                </div>
                <div class="form-group span-2">
                    <label>Gambar Hero</label>
                    <div class="img-upload-wrap" onclick="document.getElementById('heroImgIn').click()">
                        @if($about->hero_image)
                            <img src="{{ Storage::url($about->hero_image) }}" id="heroImgPrev" class="img-preview" alt="">
                        @else
                            <div class="img-preview-placeholder" id="heroImgPh">Upload</div>
                            <img src="" id="heroImgPrev" class="img-preview" style="display:none" alt="">
                        @endif
                        <div class="img-upload-info">
                            <div class="img-upload-label">{{ $about->hero_image ? 'Ganti gambar hero' : 'Upload gambar hero' }}</div>
                            <div class="img-upload-hint">Kosongkan jika tidak ingin mengubah</div>
                        </div>
                    </div>
                    <input type="file" id="heroImgIn" name="hero_image" class="hidden-file" accept="image/*">
                </div>
            </div>
        </div>

        {{-- Intro Section --}}
        <div class="card" style="grid-column:1/-1">
            <div class="card-header"><div class="card-title">Intro & Deskripsi</div></div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Intro Paragraf 1</label>
                    <textarea name="intro_1" class="form-control" rows="4" placeholder="Paragraf pertama tentang perusahaan...">{{ old('intro_1',$about->intro_1) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Intro Paragraf 2</label>
                    <textarea name="intro_2" class="form-control" rows="4" placeholder="Paragraf kedua...">{{ old('intro_2',$about->intro_2) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Vision & Mission --}}
        <div class="card">
            <div class="card-header"><div class="card-title">Visi</div></div>
            <div class="form-group">
                <textarea name="vision" class="form-control" rows="5" placeholder="Pernyataan visi perusahaan...">{{ old('vision',$about->vision) }}</textarea>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">Misi</div></div>
            <div class="form-group">
                <textarea name="mission" class="form-control" rows="5" placeholder="Pernyataan misi perusahaan...">{{ old('mission',$about->mission) }}</textarea>
            </div>
        </div>

        {{-- About Images --}}
        <div class="card" style="grid-column:1/-1">
            <div class="card-header"><div class="card-title">Foto Tentang (Multiple)</div></div>
            @if($about->about_images && count($about->about_images))
            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:12px">
                @foreach($about->about_images as $img)
                <img src="{{ Storage::url($img) }}" loading="lazy" alt=""
                     style="width:100px;height:80px;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
                @endforeach
            </div>
            <p class="form-hint">Upload baru akan menggantikan semua foto di atas</p>
            @endif
            <div style="border:1px dashed var(--border);border-radius:var(--radius);padding:16px;background:var(--bg-alt);text-align:center;cursor:pointer;margin-top:10px"
                 onclick="document.getElementById('aImgsIn').click()">
                <div style="font-size:.82rem;font-weight:500;color:var(--text)">Upload foto-foto tentang</div>
                <div style="font-size:.72rem;color:var(--text-muted);margin-top:3px">Pilih banyak file sekaligus</div>
            </div>
            <input type="file" id="aImgsIn" name="about_images[]" class="hidden-file" accept="image/*" multiple>
            <div id="aImgPreview" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:10px"></div>
        </div>
    </div>

    <div style="margin-top:16px;display:flex;justify-content:flex-end">
        <button type="submit" class="btn btn-primary" style="min-width:140px">Simpan Perubahan</button>
    </div>
</form>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    setupImagePreview('heroImgIn', 'heroImgPrev');
    document.getElementById('aImgsIn').addEventListener('change', function() {
        const c = document.getElementById('aImgPreview');
        c.innerHTML = '';
        Array.from(this.files).forEach(f => {
            const r = new FileReader();
            r.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style = 'width:80px;height:70px;object-fit:cover;border-radius:6px;border:1px solid var(--border)';
                c.appendChild(img);
            };
            r.readAsDataURL(f);
        });
    });
});
</script>
@endpush
