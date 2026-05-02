{{-- Include in <head> of every MedSyst page --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
        --teal:      #2e9d91;
        --teal-dark: #1f7a70;
        --teal-deep: #155c55;
        --teal-bg:   #e8f5f3;
        --teal-mid:  #4aada0;
        --red:       #e24b4a;
        --red-bg:    #fcebeb;
        --red-dark:  #a32d2d;
        --red-mid:   #c0392b;
        --amber:     #ef9f27;
        --amber-bg:  #faeeda;
        --amber-dark:#b36a10;
        --green:     #3b9e3b;
        --green-bg:  #eaf3de;
        --dark:      #1a1a1a;
        --mid:       #4a4a4a;
        --muted:     #8a8a8a;
        --border:    #e2e8e6;
        --surface:   #f4f7f6;
        --white:     #ffffff;
        --sidebar-w: 240px;
    }
    html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--dark); font-size: 14px; }

    .shell { display: flex; min-height: 100vh; }

  
    .sidebar { width: var(--sidebar-w); background: var(--dark); display: flex; flex-direction: column; flex-shrink: 0; padding: 0 0 1.5rem; position: sticky; top: 0; height: 100vh; overflow-y: auto; }
    .sidebar-logo { display: flex; align-items: center; gap: 10px; padding: 1.4rem 1.4rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 1rem; }
    .sidebar-logo .logo-icon { width: 34px; height: 34px; background: var(--teal); border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .sidebar-logo .logo-icon svg { width: 20px; height: 20px; }
    .sidebar-logo span { font-family: 'DM Serif Display', serif; font-size: 1.2rem; color: #fff; letter-spacing: -0.3px; }
    .nav-section { padding: 0 0.75rem; margin-bottom: 0.5rem; }
    .nav-label { font-size: 0.68rem; font-weight: 600; color: rgba(255,255,255,0.3); letter-spacing: .1em; text-transform: uppercase; padding: 0 0.65rem; margin-bottom: 4px; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 9px; color: rgba(255,255,255,0.55); font-size: 0.85rem; font-weight: 500; text-decoration: none; transition: background .15s, color .15s; margin-bottom: 2px; }
    .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
    .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.85); }
    .nav-item.active { background: var(--teal); color: #fff; }
    .nav-badge { margin-left: auto; font-size: 0.68rem; font-weight: 700; border-radius: 20px; padding: 1px 7px; }
    .nav-badge.red   { background: var(--red);   color: #fff; }
    .nav-badge.amber { background: var(--amber);  color: #fff; }
    .sidebar-spacer { flex: 1; }
    .sidebar-user { display: flex; align-items: center; gap: 10px; padding: 12px 1.4rem; border-top: 1px solid rgba(255,255,255,0.08); }
    .avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--teal); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 600; color: #fff; flex-shrink: 0; }
    .sidebar-user .user-info { flex: 1; min-width: 0; }
    .sidebar-user .user-name { font-size: 0.82rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sidebar-user .user-role { font-size: 0.72rem; color: rgba(255,255,255,0.4); }

    .main { flex: 1; display: flex; flex-direction: column; min-width: 0; overflow-x: hidden; }

    .topbar { background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; height: 60px; flex-shrink: 0; position: sticky; top: 0; z-index: 10; }
    .topbar-left { display: flex; align-items: center; gap: 12px; }
    .topbar-title h1 { font-family: 'DM Serif Display', serif; font-size: 1.35rem; color: var(--dark); letter-spacing: -0.3px; line-height: 1; }
    .topbar-title span { font-size: 0.75rem; color: var(--muted); margin-top: 2px; display: block; }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .back-btn { display: flex; align-items: center; gap: 6px; color: var(--muted); font-size: 0.82rem; text-decoration: none; padding: 6px 10px; border-radius: 8px; transition: background .15s, color .15s; }
    .back-btn:hover { background: var(--surface); color: var(--dark); }
    .back-btn svg { width: 14px; height: 14px; }
    .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: var(--muted); }
    .breadcrumb a { color: var(--teal-dark); text-decoration: none; }
    .breadcrumb a:hover { text-decoration: underline; }

    .btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 50px; font-family: 'DM Sans', sans-serif; font-size: 0.82rem; font-weight: 600; cursor: pointer; border: 1.5px solid transparent; text-decoration: none; transition: all .15s; }
    .btn svg { width: 13px; height: 13px; }
    .btn-ghost { background: transparent; color: var(--mid); border-color: var(--border); }
    .btn-ghost:hover { background: var(--surface); border-color: var(--teal); color: var(--teal); }
    .btn-primary { background: var(--dark); color: #fff; border-color: var(--dark); }
    .btn-primary:hover { background: var(--teal-deep); border-color: var(--teal-deep); }
    .btn-danger { background: var(--red); color: #fff; border-color: var(--red); }
    .btn-danger:hover { background: var(--red-mid); border-color: var(--red-mid); }
    .btn-teal { background: var(--teal); color: #fff; border-color: var(--teal); }
    .btn-teal:hover { background: var(--teal-dark); border-color: var(--teal-dark); }
    .btn-sm { padding: 5px 12px; font-size: 0.75rem; }

  
    .badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
    .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .badge-waiting  { background: #f1f0ea; color: #5a5745; }
    .badge-waiting::before  { background: #b4b09a; }
    .badge-called   { background: var(--amber-bg); color: var(--amber-dark); }
    .badge-called::before   { background: var(--amber); }
    .badge-serving  { background: var(--teal-bg); color: var(--teal-deep); }
    .badge-serving::before  { background: var(--teal); }
    .badge-done     { background: var(--green-bg); color: #2a5a11; }
    .badge-done::before     { background: var(--green); }
    .badge-critical { background: var(--red-bg); color: var(--red-dark); }
    .badge-critical::before { background: var(--red); }
    .badge-urgent   { background: var(--amber-bg); color: var(--amber-dark); }
    .badge-urgent::before   { background: var(--amber); }
    .badge-normal   { background: var(--teal-bg); color: var(--teal-deep); }
    .badge-normal::before   { background: var(--teal); }


    .content { padding: 1.75rem 2rem; flex: 1; }
    .page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 12px; }
    .page-header-left h1 { font-family: 'DM Serif Display', serif; font-size: 1.7rem; color: var(--dark); letter-spacing: -0.4px; }
    .page-header-left p { font-size: 0.85rem; color: var(--muted); margin-top: 3px; }

    .table-card { background: var(--white); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
    .table-toolbar { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border-bottom: 1px solid var(--border); gap: 12px; flex-wrap: wrap; }
    .search-wrap { position: relative; flex: 1; max-width: 300px; }
    .search-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: var(--muted); pointer-events: none; }
    .search-wrap input { width: 100%; padding: 8px 12px 8px 34px; border: 1.5px solid var(--border); border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 0.85rem; color: var(--dark); background: var(--surface); outline: none; transition: border-color .2s; }
    .search-wrap input:focus { border-color: var(--teal); background: var(--white); }
    .filter-group { display: flex; gap: 8px; flex-wrap: wrap; }
    .filter-select { padding: 7px 28px 7px 10px; border: 1.5px solid var(--border); border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 0.82rem; color: var(--mid); background: var(--surface); outline: none; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238a8a8a' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 8px center; background-size: 12px; cursor: pointer; }
    .filter-select:focus { border-color: var(--teal); }


    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: var(--surface); border-bottom: 1px solid var(--border); }
    .data-table th { padding: 10px 16px; text-align: left; font-size: 0.72rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .07em; white-space: nowrap; }
    .data-table td { padding: 12px 16px; font-size: 0.84rem; color: var(--dark); border-bottom: 1px solid var(--border); vertical-align: middle; }
    .data-table tbody tr:last-child td { border-bottom: none; }
    .data-table tbody tr { transition: background .12s; }
    .data-table tbody tr:hover { background: #fafcfc; }
    .data-table tbody tr.row-critical { border-left: 3px solid var(--red); }
    .data-table tbody tr.row-urgent   { border-left: 3px solid var(--amber); }
    .data-table tbody tr.row-normal   { border-left: 3px solid var(--teal); }

    .patient-cell { display: flex; align-items: center; gap: 10px; }
    .pt-avatar { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.72rem; font-weight: 700; flex-shrink: 0; }
    .pt-avatar.red   { background: var(--red-bg);   color: var(--red-dark); }
    .pt-avatar.amber { background: var(--amber-bg); color: var(--amber-dark); }
    .pt-avatar.teal  { background: var(--teal-bg);  color: var(--teal-deep); }
    .pt-name { font-size: 0.84rem; font-weight: 600; color: var(--dark); }
    .pt-sub  { font-size: 0.72rem; color: var(--muted); }

   
    .q-num { font-family: 'DM Serif Display', serif; font-size: 1rem; color: var(--dark); }

   
    .action-group { display: flex; gap: 6px; align-items: center; }

    .empty-state { text-align: center; padding: 3rem 2rem; }
    .empty-state svg { width: 40px; height: 40px; color: var(--border); margin: 0 auto 12px; display: block; }
    .empty-state p { font-size: 0.88rem; color: var(--muted); }

    .pagination-bar { display: flex; align-items: center; justify-content: space-between; padding: 12px 18px; border-top: 1px solid var(--border); }
    .pagination-info { font-size: 0.78rem; color: var(--muted); }
    .pagination-links { display: flex; gap: 4px; }
    .page-btn { width: 30px; height: 30px; border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: 0.78rem; font-weight: 500; border: 1.5px solid var(--border); background: var(--white); color: var(--mid); cursor: pointer; text-decoration: none; transition: all .12s; }
    .page-btn:hover { border-color: var(--teal); color: var(--teal); }
    .page-btn.active { background: var(--dark); color: #fff; border-color: var(--dark); }
    .page-btn:disabled { opacity: .4; cursor: default; }

    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }
    .live-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--red); display: inline-block; animation: pulse 1.6s ease-in-out infinite; }
    .live-label { display: flex; align-items: center; gap: 6px; font-size: 0.72rem; color: var(--red-dark); font-weight: 600; }

    @media (max-width: 960px) { .sidebar { display: none; } }
</style>