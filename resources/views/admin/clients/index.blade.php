@extends('admin.layout')
@section('title','Klien')
@section('page-title','Klien')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Daftar Klien</h2><p>{{ $items->total() }} klien</p></div>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">+ Tambah Klien</a>
</div>
<div class="card">
    <div class="skeleton-container">
        @for($i=0;$i<6;$i++)<div class="skeleton-row">
            <div class="skeleton" style="width:40px;height:40px;border-radius:6px;flex-shrink:0"></div>
            <div style="flex:1;display:flex;flex-direction:column;gap:6px">
                <div class="skeleton" style="width:40%;height:13px"></div>
            </div>
            <div class="skeleton" style="width:80px;height:28px;border-radius:6px"></div>
        </div>@endfor
    </div>
    <div class="real-content">
        @if($items->isEmpty())
            <div class="empty-state"><p>Belum ada klien. <a href="{{ route('admin.clients.create') }}" style="color:#818cf8">Tambah sekarang</a></p></div>
        @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>Logo</th><th>Nama Klien</th><th>Urutan</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td>@if($item->logo)<img src="{{ Storage::url($item->logo) }}" class="thumb" loading="lazy" alt="">@else<div class="thumb-placeholder">-</div>@endif</td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->sort_order ?? '-' }}</td>
                    <td><div class="actions-cell">
                        <a href="{{ route('admin.clients.edit',$item) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <button onclick="confirmDelete('{{ route('admin.clients.destroy',$item) }}')" class="btn btn-danger btn-sm">Hapus</button>
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
