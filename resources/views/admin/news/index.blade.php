@extends('admin.layout')
@section('title','Berita')
@section('page-title','Berita')
@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Daftar Berita</h2>
        <p>{{ $items->total() }} berita ditemukan</p>
    </div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Tambah Berita
    </a>
</div>

<div class="card">
    {{-- Skeleton --}}
    <div class="skeleton-container">
        <div class="table-wrap">
            @for($i=0;$i<8;$i++)<div class="skeleton-row">
                <div class="skeleton" style="width:40px;height:40px;border-radius:6px;flex-shrink:0"></div>
                <div style="flex:1;display:flex;flex-direction:column;gap:6px">
                    <div class="skeleton" style="width:55%;height:13px"></div>
                    <div class="skeleton" style="width:30%;height:10px"></div>
                </div>
                <div class="skeleton" style="width:100px;height:28px;border-radius:6px"></div>
            </div>@endfor
        </div>
    </div>

    {{-- Real Table --}}
    <div class="real-content">
        @if($items->isEmpty())
            <div class="empty-state"><p>Belum ada berita. <a href="{{ route('admin.news.create') }}" style="color:#818cf8">Tambah sekarang</a></p></div>
        @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>Gambar</th><th>Judul</th><th>Sumber</th><th>Tanggal</th><th>Urutan</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>
                            @if($item->image)<img src="{{ Storage::url($item->image) }}" class="thumb" loading="lazy" alt="">
                            @else<div class="thumb-placeholder">-</div>@endif
                        </td>
                        <td><strong>{{ Str::limit($item->title,60) }}</strong>
                            @if($item->url)<br><a href="{{ $item->url }}" target="_blank" style="font-size:.7rem;color:#818cf8">{{ Str::limit($item->url,40) }}</a>@endif
                        </td>
                        <td>{{ $item->site_name ?? '-' }}</td>
                        <td>{{ $item->published_at?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $item->sort_order ?? '-' }}</td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('admin.news.edit',$item) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <button onclick="confirmDelete('{{ route('admin.news.destroy',$item) }}')" class="btn btn-danger btn-sm">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $items->links() }}</div>
        @endif
    </div>
</div>
@endsection
