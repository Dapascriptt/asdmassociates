@extends('admin.layout')
@section('title','Mitra')
@section('page-title','Mitra & Klien')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Daftar Mitra</h2><p>{{ $items->total() }} mitra/klien</p></div>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">+ Tambah Mitra</a>
</div>
<div class="card">
    <div class="skeleton-container">
        @for($i=0;$i<8;$i++)<div class="skeleton-row">
            <div class="skeleton" style="width:40px;height:40px;border-radius:6px;flex-shrink:0"></div>
            <div style="flex:1;display:flex;flex-direction:column;gap:6px">
                <div class="skeleton" style="width:40%;height:13px"></div>
                <div class="skeleton" style="width:20%;height:10px"></div>
            </div>
            <div class="skeleton" style="width:80px;height:24px;border-radius:20px"></div>
            <div class="skeleton" style="width:80px;height:28px;border-radius:6px;margin-left:8px"></div>
        </div>@endfor
    </div>
    <div class="real-content">
        @if($items->isEmpty())
            <div class="empty-state"><p>Belum ada mitra. <a href="{{ route('admin.partners.create') }}" style="color:#818cf8">Tambah sekarang</a></p></div>
        @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>Logo</th><th>Nama</th><th>Urutan</th><th>Tipe</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td>@if($item->logo)<img src="{{ Storage::url($item->logo) }}" class="thumb" loading="lazy" alt="">@else<div class="thumb-placeholder">-</div>@endif</td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->order ?? '-' }}</td>
                    <td>@if($item->is_client)<span class="badge badge-info">Klien</span>@else<span class="badge badge-neutral">Mitra</span>@endif</td>
                    <td>@if($item->is_active)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif</td>
                    <td><div class="actions-cell">
                        <a href="{{ route('admin.partners.edit',$item) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <button onclick="confirmDelete('{{ route('admin.partners.destroy',$item) }}')" class="btn btn-danger btn-sm">Hapus</button>
                    </div></td>
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
