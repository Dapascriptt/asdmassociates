@extends('admin.layout')
@section('title','Galeri')
@section('page-title','Galeri')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Daftar Galeri</h2><p>{{ $items->total() }} item galeri</p></div>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Tambah Galeri</a>
</div>
<div class="card">
    <div class="skeleton-container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:14px;padding:4px">
            @for($i=0;$i<8;$i++)
            <div>
                <div class="skeleton" style="width:100%;aspect-ratio:1;border-radius:8px;margin-bottom:8px"></div>
                <div class="skeleton" style="width:70%;height:12px;margin-bottom:4px"></div>
                <div class="skeleton" style="width:50%;height:10px"></div>
            </div>
            @endfor
        </div>
    </div>
    <div class="real-content">
        @if($items->isEmpty())
            <div class="empty-state"><p>Belum ada galeri. <a href="{{ route('admin.gallery.create') }}" style="color:#818cf8">Tambah sekarang</a></p></div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:14px">
            @foreach($items as $item)
            <div class="card" style="padding:12px;display:flex;flex-direction:column;gap:8px">
                @if($item->image)
                    <img src="{{ Storage::url($item->image) }}" loading="lazy" alt=""
                         style="width:100%;aspect-ratio:1;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
                @else
                    <div style="width:100%;aspect-ratio:1;background:var(--bg-surface);border-radius:6px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:.75rem">No image</div>
                @endif
                <div style="font-size:.78rem;font-weight:500;color:var(--text)">{{ $item->title ?? 'Tanpa Judul' }}</div>
                @if($item->images && count($item->images))
                    <span class="badge badge-info" style="width:fit-content">{{ count($item->images) }} foto</span>
                @endif
                <div class="actions-cell">
                    <a href="{{ route('admin.gallery.edit',$item) }}" class="btn btn-secondary btn-sm" style="flex:1;justify-content:center">Edit</a>
                    <button onclick="confirmDelete('{{ route('admin.gallery.destroy',$item) }}')" class="btn btn-danger btn-sm">×</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrap">{{ $items->links() }}</div>
        @endif
    </div>
</div>
@endsection
