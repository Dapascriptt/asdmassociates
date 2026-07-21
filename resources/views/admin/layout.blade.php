<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — ASDM CMS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#f7fdf8;
            --bg-alt:#f0f8f2;
            --surface:#fff;
            --surface-hover:#fafcfb;
            --border:#e2e8e4;
            --border-light:#eef2ef;
            --text:#1a2e1f;
            --text-secondary:#4a6350;
            --text-muted:#7c9484;
            --accent:#166534;
            --accent-hover:#15803d;
            --accent-light:#f0fdf4;
            --accent-subtle:#dcfce7;
            --accent-ring:rgba(22,101,52,.12);
            --danger:#b91c1c;
            --danger-light:#fef2f2;
            --danger-ring:rgba(185,28,28,.08);
            --success:#166534;
            --success-light:#f0fdf4;
            --warning:#92400e;
            --warning-light:#fffbeb;
            --sidebar-w:240px;
            --topbar-h:52px;
            --radius:8px;
            --radius-sm:6px;
            --shadow:0 1px 3px rgba(0,0,0,.06),0 1px 2px rgba(0,0,0,.04);
            --shadow-md:0 4px 12px rgba(0,0,0,.06);
        }

        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{font-size:14px}
        body{
            font-family:'Plus Jakarta Sans',system-ui,-apple-system,sans-serif;
            background:var(--bg);color:var(--text);
            line-height:1.5;min-height:100vh;display:flex;
        }
        a{color:inherit;text-decoration:none}
        img{max-width:100%;display:block}
        button,input,select,textarea{font-family:inherit;font-size:inherit}
        ul{list-style:none}

        /* Sidebar */
        .sidebar{
            position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);
            background:var(--surface);border-right:1px solid var(--border);
            display:flex;flex-direction:column;z-index:100;
            transition:transform .2s ease;overflow-y:auto;
        }
        .sidebar.collapsed{transform:translateX(-100%)}
        .sidebar-brand{
            display:flex;align-items:center;gap:10px;
            padding:16px 16px 14px;border-bottom:1px solid var(--border-light);
        }
        .brand-logo{
            width:32px;height:32px;border-radius:var(--radius-sm);
            background:var(--accent);display:flex;align-items:center;justify-content:center;
            font-weight:700;font-size:.8rem;color:#fff;flex-shrink:0;
        }
        .brand-text{line-height:1.2}
        .brand-name{font-weight:700;font-size:.82rem;color:var(--text)}
        .brand-sub{font-size:.65rem;color:var(--text-muted);font-weight:500}

        .sidebar-nav{flex:1;padding:8px 0}
        .nav-label{
            padding:12px 16px 4px;font-size:.65rem;font-weight:600;
            letter-spacing:.06em;color:var(--text-muted);text-transform:uppercase;
        }
        .nav-item{
            display:flex;align-items:center;gap:8px;
            padding:7px 12px;margin:1px 8px;border-radius:var(--radius-sm);
            color:var(--text-secondary);font-size:.8rem;font-weight:500;
            transition:background .15s,color .15s;
        }
        .nav-item:hover{background:var(--accent-light);color:var(--accent)}
        .nav-item.active{background:var(--accent-subtle);color:var(--accent);font-weight:600}
        .nav-icon{width:16px;height:16px;flex-shrink:0;opacity:.65}
        .nav-item.active .nav-icon,.nav-item:hover .nav-icon{opacity:1}

        .sidebar-footer{padding:12px 16px;border-top:1px solid var(--border-light)}
        .user-row{display:flex;align-items:center;gap:8px;margin-bottom:8px}
        .user-avatar{
            width:28px;height:28px;border-radius:50%;background:var(--accent);
            display:flex;align-items:center;justify-content:center;
            font-weight:700;font-size:.7rem;color:#fff;flex-shrink:0;
        }
        .user-name{font-weight:600;font-size:.78rem;color:var(--text)}
        .user-email{font-size:.65rem;color:var(--text-muted)}
        .btn-logout{
            width:100%;padding:6px 10px;border-radius:var(--radius-sm);
            background:var(--danger-light);color:var(--danger);border:1px solid rgba(185,28,28,.1);
            font-size:.75rem;font-weight:500;cursor:pointer;
            display:flex;align-items:center;justify-content:center;gap:5px;
            transition:background .15s;
        }
        .btn-logout:hover{background:#fde8e8}

        /* Main */
        .main-wrapper{
            margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;
            min-height:100vh;transition:margin-left .2s ease;
        }
        .sidebar.collapsed ~ .main-wrapper{margin-left:0}

        /* Topbar */
        .topbar{
            height:var(--topbar-h);background:var(--surface);
            border-bottom:1px solid var(--border-light);
            display:flex;align-items:center;justify-content:space-between;
            padding:0 20px;position:sticky;top:0;z-index:50;
        }
        .topbar-left{display:flex;align-items:center;gap:10px}
        .sidebar-toggle{
            background:none;border:none;cursor:pointer;
            color:var(--text-muted);padding:4px;border-radius:var(--radius-sm);
            display:flex;align-items:center;transition:color .15s,background .15s;
        }
        .sidebar-toggle:hover{color:var(--text);background:var(--accent-light)}
        .page-title{font-size:.85rem;font-weight:600;color:var(--text)}

        /* Content */
        .main-content{flex:1;padding:20px;max-width:1280px;width:100%}

        /* Card */
        .card{
            background:var(--surface);border:1px solid var(--border);
            border-radius:var(--radius);padding:16px;box-shadow:var(--shadow);
        }
        .card-header{
            display:flex;align-items:center;justify-content:space-between;
            margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid var(--border-light);
        }
        .card-title{font-size:.85rem;font-weight:600;color:var(--text)}
        .card-subtitle{font-size:.72rem;color:var(--text-muted);margin-top:2px}

        /* Tables */
        .table-wrap{overflow-x:auto;border-radius:var(--radius);border:1px solid var(--border)}
        table{width:100%;border-collapse:collapse}
        thead th{
            padding:8px 12px;background:var(--bg-alt);
            font-size:.7rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;
            color:var(--text-muted);text-align:left;border-bottom:1px solid var(--border);
            white-space:nowrap;
        }
        tbody tr{border-bottom:1px solid var(--border-light);transition:background .1s}
        tbody tr:last-child{border-bottom:none}
        tbody tr:hover{background:var(--accent-light)}
        td{padding:8px 12px;font-size:.8rem;color:var(--text-secondary);vertical-align:middle}
        td strong{color:var(--text);font-weight:500}

        .thumb{
            width:36px;height:36px;object-fit:cover;border-radius:var(--radius-sm);
            border:1px solid var(--border);background:var(--bg-alt);
        }
        .thumb-placeholder{
            width:36px;height:36px;border-radius:var(--radius-sm);
            background:var(--bg-alt);border:1px solid var(--border);
            display:flex;align-items:center;justify-content:center;
            color:var(--text-muted);font-size:.6rem;
        }

        /* Skeleton */
        @keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}
        .skeleton{
            background:linear-gradient(90deg,var(--border-light) 25%,#fff 50%,var(--border-light) 75%);
            background-size:200% 100%;animation:shimmer 1.4s infinite;
            border-radius:var(--radius-sm);display:inline-block;
        }
        .skeleton-row{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-bottom:1px solid var(--border-light);
        }
        .skeleton-row:last-child{border-bottom:none}
        .skeleton-container{display:block}
        .real-content{display:none}
        body.dom-ready .skeleton-container{display:none}
        body.dom-ready .real-content{display:block}

        /* Buttons */
        .btn{
            display:inline-flex;align-items:center;gap:5px;
            padding:7px 14px;border-radius:var(--radius-sm);
            font-size:.78rem;font-weight:500;cursor:pointer;
            border:1px solid transparent;transition:all .15s;line-height:1;
        }
        .btn-primary{
            background:var(--accent);color:#fff;border-color:var(--accent);
        }
        .btn-primary:hover{background:var(--accent-hover)}
        .btn-secondary{
            background:var(--surface);color:var(--text-secondary);border-color:var(--border);
        }
        .btn-secondary:hover{background:var(--bg-alt);color:var(--text)}
        .btn-danger{background:var(--danger-light);color:var(--danger);border-color:rgba(185,28,28,.15)}
        .btn-danger:hover{background:#fde8e8}
        .btn-sm{padding:5px 10px;font-size:.72rem}

        /* Badges */
        .badge{
            display:inline-flex;align-items:center;
            padding:2px 8px;border-radius:20px;font-size:.68rem;font-weight:600;
        }
        .badge-success{background:var(--success-light);color:var(--success)}
        .badge-danger{background:var(--danger-light);color:var(--danger)}
        .badge-warning{background:var(--warning-light);color:var(--warning)}
        .badge-info{background:var(--accent-subtle);color:var(--accent)}
        .badge-neutral{background:var(--bg-alt);color:var(--text-muted)}

        /* Forms */
        .form-grid{display:grid;grid-template-columns:1fr;gap:14px}
        .form-grid-2{grid-template-columns:repeat(2,1fr)}
        .form-grid-3{grid-template-columns:repeat(3,1fr)}
        @media(max-width:640px){.form-grid-2,.form-grid-3{grid-template-columns:1fr}}
        .form-group{display:flex;flex-direction:column;gap:4px}
        .form-group.span-2{grid-column:span 2}
        .form-group.span-3{grid-column:1/-1}
        label{font-size:.75rem;font-weight:500;color:var(--text-secondary)}
        label span.req{color:var(--danger);margin-left:2px}
        .form-control{
            background:var(--surface);border:1px solid var(--border);
            border-radius:var(--radius-sm);color:var(--text);
            padding:8px 10px;font-size:.8rem;transition:border-color .15s,box-shadow .15s;
            width:100%;outline:none;
        }
        .form-control:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-ring)}
        .form-control::placeholder{color:var(--text-muted)}
        textarea.form-control{resize:vertical;min-height:90px}
        select.form-control{cursor:pointer}
        .form-hint{font-size:.68rem;color:var(--text-muted)}
        .form-error{font-size:.7rem;color:var(--danger)}

        /* Toggle */
        .toggle-group{display:flex;align-items:center;gap:8px;cursor:pointer}
        .toggle-group input[type=checkbox]{
            appearance:none;width:34px;height:18px;
            background:var(--border);border-radius:9px;cursor:pointer;
            position:relative;transition:background .15s;flex-shrink:0;
        }
        .toggle-group input[type=checkbox]:checked{background:var(--accent)}
        .toggle-group input[type=checkbox]::after{
            content:'';position:absolute;top:2px;left:2px;
            width:14px;height:14px;background:#fff;border-radius:50%;
            transition:transform .15s;
        }
        .toggle-group input[type=checkbox]:checked::after{transform:translateX(16px)}
        .toggle-label{font-size:.78rem;color:var(--text-secondary)}

        /* Image upload */
        .img-upload-wrap{
            border:1px dashed var(--border);border-radius:var(--radius);
            padding:14px;display:flex;align-items:center;gap:12px;
            background:var(--bg-alt);cursor:pointer;transition:border-color .15s;
        }
        .img-upload-wrap:hover{border-color:var(--accent)}
        .img-preview{
            width:56px;height:56px;object-fit:cover;
            border-radius:var(--radius-sm);border:1px solid var(--border);flex-shrink:0;
        }
        .img-preview-placeholder{
            width:56px;height:56px;border-radius:var(--radius-sm);
            background:var(--surface);border:1px solid var(--border);
            display:flex;align-items:center;justify-content:center;
            color:var(--text-muted);font-size:.65rem;flex-shrink:0;text-align:center;
        }
        .img-upload-info{flex:1;min-width:0}
        .img-upload-label{font-size:.78rem;font-weight:500;color:var(--text)}
        .img-upload-hint{font-size:.68rem;color:var(--text-muted);margin-top:2px}
        input[type=file].hidden-file{display:none}

        /* Pagination */
        .pagination-wrap{display:flex;justify-content:flex-end;margin-top:14px}
        .pagination-wrap .pagination{display:flex;gap:3px;flex-wrap:wrap}
        .pagination li a,.pagination li span{
            display:flex;align-items:center;justify-content:center;
            width:30px;height:30px;border-radius:var(--radius-sm);
            font-size:.75rem;font-weight:500;
            border:1px solid var(--border);background:var(--surface);color:var(--text-muted);
            transition:all .15s;
        }
        .pagination li.active span{background:var(--accent);color:#fff;border-color:var(--accent)}
        .pagination li a:hover{background:var(--accent-light);color:var(--accent);border-color:var(--accent-ring)}
        .pagination li.disabled span{opacity:.35;cursor:not-allowed}

        /* Toasts */
        .toast-stack{
            position:fixed;top:14px;right:14px;z-index:9000;
            display:flex;flex-direction:column;gap:6px;max-width:320px;pointer-events:none;
        }
        .toast{
            display:flex;align-items:flex-start;gap:8px;
            padding:10px 12px;border-radius:var(--radius);
            background:var(--surface);border:1px solid var(--border);
            box-shadow:var(--shadow-md);pointer-events:auto;
            animation:toastIn .2s ease forwards;
        }
        .toast.hiding{animation:toastOut .2s ease forwards}
        @keyframes toastIn{from{transform:translateX(100%);opacity:0}to{transform:none;opacity:1}}
        @keyframes toastOut{from{transform:none;opacity:1}to{transform:translateX(100%);opacity:0}}
        .toast-success{border-left:3px solid var(--success)}
        .toast-error{border-left:3px solid var(--danger)}
        .toast-body{flex:1;font-size:.78rem;color:var(--text)}
        .toast-close{
            background:none;border:none;color:var(--text-muted);cursor:pointer;
            font-size:.9rem;line-height:1;padding:0;transition:color .15s;
        }
        .toast-close:hover{color:var(--text)}

        /* Delete modal */
        .modal-backdrop{
            position:fixed;inset:0;background:rgba(0,0,0,.3);
            z-index:200;display:none;align-items:center;justify-content:center;
        }
        .modal-backdrop.active{display:flex}
        .modal-box{
            background:var(--surface);border:1px solid var(--border);
            border-radius:var(--radius);padding:20px;
            max-width:380px;width:90%;box-shadow:var(--shadow-md);
        }
        .modal-title{font-size:.88rem;font-weight:600;color:var(--text);margin-bottom:6px}
        .modal-body{font-size:.78rem;color:var(--text-secondary);margin-bottom:16px;line-height:1.5}
        .modal-actions{display:flex;gap:8px;justify-content:flex-end}

        /* Helpers */
        .page-header{
            display:flex;align-items:center;justify-content:space-between;
            margin-bottom:16px;flex-wrap:wrap;gap:8px;
        }
        .page-header-left h2{font-size:.95rem;font-weight:700;color:var(--text)}
        .page-header-left p{font-size:.72rem;color:var(--text-muted);margin-top:1px}
        .empty-state{text-align:center;padding:40px 20px;color:var(--text-muted)}
        .empty-state p{font-size:.82rem}
        .divider{height:1px;background:var(--border-light);margin:16px 0}
        .actions-cell{display:flex;align-items:center;gap:5px;white-space:nowrap}

        @media(max-width:768px){
            .sidebar{transform:translateX(-100%)}
            .sidebar.open{transform:none}
            .main-wrapper{margin-left:0}
            .main-content{padding:14px}
            .topbar{padding:0 14px}
        }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">A</div>
        <div class="brand-text">
            <span class="brand-name">ASDM Associates</span>
            <span class="brand-sub">Panel Admin</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <div class="nav-label">Konten</div>
        <a href="{{ route('admin.news.index') }}" class="nav-item {{ request()->routeIs('admin.news*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            Berita
        </a>
        <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Layanan
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="nav-item {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Galeri
        </a>

        <div class="nav-label">Entitas</div>
        <a href="{{ route('admin.members.index') }}" class="nav-item {{ request()->routeIs('admin.members*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Anggota
        </a>
        <a href="{{ route('admin.partners.index') }}" class="nav-item {{ request()->routeIs('admin.partners*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Mitra
        </a>
        <a href="{{ route('admin.clients.index') }}" class="nav-item {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Klien
        </a>
        <a href="{{ route('admin.team.index') }}" class="nav-item {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Tim
        </a>
        <a href="{{ route('admin.certifications.index') }}" class="nav-item {{ request()->routeIs('admin.certifications*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            Sertifikasi
        </a>
        <a href="{{ route('admin.portfolio.index') }}" class="nav-item {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Portofolio
        </a>

        <div class="nav-label">Pengaturan</div>
        <a href="{{ route('admin.about.edit') }}" class="nav-item {{ request()->routeIs('admin.about*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Tentang
        </a>
        <a href="{{ route('admin.service-page.edit') }}" class="nav-item {{ request()->routeIs('admin.service-page*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h7"/></svg>
            Halaman Layanan
        </a>
        <a href="{{ route('admin.contact.edit') }}" class="nav-item {{ request()->routeIs('admin.contact*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Kontak
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-row">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name ?? '-' }}</div>
                <div class="user-email">{{ auth()->user()->email ?? '-' }}</div>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <header class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>
</div>

<div class="toast-stack" id="toast-stack">
    @if(session('success'))
        <div class="toast toast-success" data-toast>
            <span class="toast-body">{{ session('success') }}</span>
            <button class="toast-close" onclick="dismissToast(this)">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="toast toast-error" data-toast>
            <span class="toast-body">{{ session('error') }}</span>
            <button class="toast-close" onclick="dismissToast(this)">&times;</button>
        </div>
    @endif
</div>

<div class="modal-backdrop" id="deleteModal">
    <div class="modal-box">
        <div class="modal-title">Konfirmasi Hapus</div>
        <p class="modal-body">Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeModal()">Batal</button>
            <form id="deleteForm" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){document.body.classList.add('dom-ready')});
var sidebar=document.getElementById('sidebar');
document.getElementById('sidebarToggle').addEventListener('click',function(){
    window.innerWidth<=768?sidebar.classList.toggle('open'):sidebar.classList.toggle('collapsed');
});
function dismissToast(b){var t=b.closest('[data-toast]');if(!t)return;t.classList.add('hiding');setTimeout(function(){t.remove()},220)}
document.querySelectorAll('[data-toast]').forEach(function(t){setTimeout(function(){dismissToast(t.querySelector('.toast-close'))},4000)});
function confirmDelete(u){document.getElementById('deleteForm').action=u;document.getElementById('deleteModal').classList.add('active')}
function closeModal(){document.getElementById('deleteModal').classList.remove('active')}
document.getElementById('deleteModal').addEventListener('click',function(e){if(e.target===this)closeModal()});
function setupImagePreview(inputId,previewId){
    var input=document.getElementById(inputId),preview=document.getElementById(previewId);
    if(!input||!preview)return;
    input.addEventListener('change',function(){
        if(this.files&&this.files[0]){
            var r=new FileReader();
            r.onload=function(e){preview.src=e.target.result;preview.style.display='block';
                var ph=preview.parentElement.querySelector('.img-preview-placeholder');if(ph)ph.style.display='none';
            };r.readAsDataURL(this.files[0]);
        }
    });
}
</script>
@stack('scripts')
</body>
</html>
