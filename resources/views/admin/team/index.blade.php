@extends('admin.layout')
@section('title','Tim')
@section('page-title','Anggota Tim')
@section('content')
<div class="page-header">
    <div class="page-header-left"><h2>Daftar Tim</h2><p>{{ $items->total() }} anggota tim</p></div>
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary">+ Tambah</a>
</div>
<div class="card">
    <div class="skeleton-container">
        @for($i=0;$i<6;$i++)<div class="skeleton-row">
            <div class="skeleton" style="width:40px;height:40px;border-radius:50%;flex-shrink:0"></div>
            <div style="flex:1;display:flex;flex-direction:column;gap:6px">
                <div class="skeleton" style="width:45%;height:13px"></div>
                <div class="skeleton" style="width:30%;height:10px"></div>
            </div>
            <div class="skeleton" style="width:80px;height:28px;border-radius:6px"></div>
        </div>@endfor
    </div>
    <div class="real-content">
        @if($items->isEmpty())
            <div class="empty-state"><p>Belum ada tim. <a href="{{ route('admin.team.create') }}" style="color:#818cf8">Tambah sekarang</a></p></div>
        @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>Foto</th><th>Nama</th><th>Posisi</th><th>Keahlian</th><th>Urutan</th><th>Aksi</th></tr></thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td>@if($item->photo)<img src="{{ Storage::url($item->photo) }}" class="thumb" loading="lazy" style="border-radius:50%" alt="">@else<div class="thumb-placeholder" style="border-radius:50%">-</div>@endif</td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->position ?? '-' }}</td>
                    <td>
                        @if($item->practice_areas && count($item->practice_areas))
                            @foreach(array_slice($item->practice_areas,0,2) as $area)
                                <span class="badge badge-neutral" style="margin:1px">{{ Str::limit($area,20) }}</span>
                            @endforeach
                            @if(count($item->practice_areas)>2)<span style="font-size:.7rem;color:var(--text-muted)">+{{ count($item->practice_areas)-2 }}</span>@endif
                        @else
                            <span style="color:var(--text-muted)">-</span>
                        @endif
                    </td>
                    <td>{{ $item->sort_order ?? '-' }}</td>
                    <td><div class="actions-cell">
                        <a href="{{ route('admin.team.edit',$item) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <button onclick="confirmDelete('{{ route('admin.team.destroy',$item) }}')" class="btn btn-danger btn-sm">Hapus</button>
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
