@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h2>Ringkasan Konten</h2>
        <p>Statistik semua data di website ASDM Associates</p>
    </div>
    <span class="badge badge-info">{{ now()->format('d M Y') }}</span>
</div>

{{-- Stats Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:12px;margin-bottom:20px;">
    @php
    $statItems = [
        ['label'=>'Berita','value'=>$stats['news'],'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z','route'=>'admin.news.index'],
        ['label'=>'Layanan','value'=>$stats['services'],'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2','route'=>'admin.services.index'],
        ['label'=>'Anggota','value'=>$stats['members'],'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','route'=>'admin.members.index'],
        ['label'=>'Mitra','value'=>$stats['partners'],'icon'=>'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z','route'=>'admin.partners.index'],
        ['label'=>'Klien','value'=>$stats['clients'],'icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4','route'=>'admin.clients.index'],
        ['label'=>'Galeri','value'=>$stats['gallery'],'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z','route'=>'admin.gallery.index'],
        ['label'=>'Portofolio','value'=>$stats['portfolio'],'icon'=>'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4','route'=>'admin.portfolio.index'],
        ['label'=>'Sertifikasi','value'=>$stats['certifications'],'icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z','route'=>'admin.certifications.index'],
        ['label'=>'Tim','value'=>$stats['team'],'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','route'=>'admin.team.index'],
    ];
    @endphp

    @foreach($statItems as $s)
    <a href="{{ route($s['route']) }}" style="text-decoration:none">
        <div class="card" style="transition:border-color .15s;cursor:pointer">
            <div class="skeleton-container" style="height:60px">
                <div class="skeleton" style="width:32px;height:32px;border-radius:6px;margin-bottom:8px"></div>
                <div class="skeleton" style="width:50px;height:18px"></div>
            </div>
            <div class="real-content">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px">
                    <span style="font-size:.75rem;color:var(--text-muted);font-weight:500">{{ $s['label'] }}</span>
                    <div style="width:28px;height:28px;border-radius:6px;background:var(--accent-light);display:flex;align-items:center;justify-content:center">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="var(--accent)" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                </div>
                <div style="font-size:1.3rem;font-weight:700;color:var(--text);line-height:1">{{ $s['value'] }}</div>
            </div>
        </div>
    </a>
    @endforeach
</div>

{{-- Latest News --}}
<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Berita Terbaru</div>
            <div class="card-subtitle">5 berita terakhir yang ditambahkan</div>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">+ Tambah Berita</a>
    </div>

    {{-- Skeleton --}}
    <div class="skeleton-container">
        @for($i=0;$i<5;$i++)
        <div class="skeleton-row">
            <div class="skeleton" style="width:36px;height:36px;border-radius:6px;flex-shrink:0"></div>
            <div style="flex:1;display:flex;flex-direction:column;gap:6px">
                <div class="skeleton" style="width:60%;height:13px"></div>
                <div class="skeleton" style="width:35%;height:10px"></div>
            </div>
            <div class="skeleton" style="width:80px;height:22px;border-radius:20px"></div>
        </div>
        @endfor
    </div>

    {{-- Real content --}}
    <div class="real-content">
        @if($latestNews->isEmpty())
            <div class="empty-state" style="padding:24px">
                <p>Belum ada berita. <a href="{{ route('admin.news.create') }}" style="color:var(--accent);font-weight:500">Tambah sekarang</a></p>
            </div>
        @else
        <div class="table-wrap" style="border:none">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Sumber</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestNews as $n)
                    <tr>
                        <td>
                            @if($n->image)
                                <img src="{{ Storage::url($n->image) }}" class="thumb" loading="lazy" alt="{{ $n->title }}">
                            @else
                                <div class="thumb-placeholder">-</div>
                            @endif
                        </td>
                        <td><strong>{{ Str::limit($n->title, 50) }}</strong></td>
                        <td>{{ $n->site_name ?? '-' }}</td>
                        <td>{{ $n->published_at ? $n->published_at->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $n) }}" class="btn btn-secondary btn-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
