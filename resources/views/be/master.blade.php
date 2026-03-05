<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'BioPharm' }} — Dashboard</title>

    <!-- Vendor CSS (existing) -->
    <link rel="stylesheet" href="{{ asset('back-end/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/flag-icon-css/css/flag-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/vendors/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/css/vertical-light-layout/style.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts: Manrope -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('back-end/images/favicon.png') }}">

    <style>
        /* ============================================================
           BIOPHARM DESIGN SYSTEM — ORANGE & WHITE THEME
           All custom classes prefixed with "bph-" to avoid collisions
        ============================================================ */
        :root {
            --bph-orange:        #F97316;
            --bph-orange-hover:  #EA580C;
            --bph-orange-light:  #FFF7ED;
            --bph-orange-soft:   #FFEDD5;
            --bph-orange-border: #FED7AA;
            --bph-white:         #FFFFFF;
            --bph-bg:            #F8F9FB;
            --bph-dark:          #18181B;
            --bph-text:          #3F3F46;
            --bph-muted:         #71717A;
            --bph-border:        #E4E4E7;
            --bph-sidebar-bg:    #1A1A2E;
            --bph-sidebar-hover: rgba(249,115,22,0.12);
            --bph-sidebar-active:#F97316;
            --bph-sidebar-w:     260px;
            --bph-navbar-h:      64px;
            --bph-radius:        10px;
            --bph-radius-sm:     6px;
            --bph-shadow:        0 1px 8px rgba(0,0,0,0.07);
            --bph-shadow-md:     0 4px 20px rgba(0,0,0,0.09);
            --bph-shadow-lg:     0 8px 32px rgba(0,0,0,0.12);
            --bph-transition:    0.2s ease;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { font-size: 15px; }

        body {
            font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif !important;
            background: var(--bph-bg) !important;
            color: var(--bph-text) !important;
            min-height: 100vh;
        }

        /* ---- Scrollbar ---- */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--bph-orange-border); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--bph-orange); }

        /* ============================================================
           LAYOUT SHELL
        ============================================================ */
        .bph-layout {
            display: flex;
            min-height: 100vh;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */
        .bph-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--bph-sidebar-w);
            height: 100vh;
            background: var(--bph-sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1050;
            transition: transform var(--bph-transition), width var(--bph-transition);
            overflow: hidden;
            box-shadow: 2px 0 20px rgba(0,0,0,0.15);
        }

        /* Brand in Sidebar */
        .bph-sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            height: var(--bph-navbar-h);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            flex-shrink: 0;
            text-decoration: none;
        }

        .bph-brand-icon {
            width: 38px; height: 38px;
            background: var(--bph-orange);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .bph-brand-icon i { font-size: 1.1rem; color: #fff; }

        .bph-brand-text { line-height: 1; }
        .bph-brand-text .t1 { font-size: 1rem; font-weight: 800; color: #fff; }
        .bph-brand-text .t2 { font-size: 0.72rem; color: var(--bph-orange); font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; }

        /* Sidebar Profile */
        .bph-sidebar-profile {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .bph-sidebar-avatar {
            width: 42px; height: 42px;
            border-radius: 50%;
            border: 2.5px solid var(--bph-orange);
            object-fit: cover;
            flex-shrink: 0;
        }

        .bph-sidebar-uname {
            font-size: 0.85rem; font-weight: 700;
            color: #fff;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 140px;
        }

        .bph-sidebar-role {
            font-size: 0.72rem; color: rgba(255,255,255,0.45);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 140px;
        }

        .bph-sidebar-logout-btn {
            display: inline-flex; align-items: center; gap: 5px;
            margin-top: 6px;
            background: rgba(249,115,22,0.15);
            border: 1px solid rgba(249,115,22,0.3);
            color: var(--bph-orange) !important;
            border-radius: 5px;
            padding: 3px 8px;
            font-size: 0.72rem; font-weight: 700;
            cursor: pointer;
            transition: all var(--bph-transition);
        }
        .bph-sidebar-logout-btn:hover { background: var(--bph-orange); color: #fff !important; }

        /* Sidebar Nav */
        .bph-nav-section-label {
            font-size: 0.65rem; font-weight: 800;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 14px 20px 5px;
        }

        .bph-nav-list { list-style: none; padding: 4px 12px; margin: 0; }

        .bph-nav-link {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 12px;
            border-radius: var(--bph-radius-sm);
            color: rgba(255,255,255,0.6) !important;
            text-decoration: none !important;
            font-size: 0.875rem; font-weight: 500;
            transition: all var(--bph-transition);
            position: relative;
        }

        .bph-nav-link:hover {
            background: var(--bph-sidebar-hover);
            color: #fff !important;
        }
        .bph-nav-link:hover .bph-nav-icon { color: var(--bph-orange); }

        .bph-nav-link.bph-active {
            background: var(--bph-orange);
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(249,115,22,0.35);
        }
        .bph-nav-link.bph-active .bph-nav-icon { color: #fff; }

        .bph-nav-icon {
            font-size: 1rem; width: 20px;
            text-align: center;
            color: rgba(255,255,255,0.3);
            flex-shrink: 0;
            transition: color var(--bph-transition);
        }

        .bph-sidebar-footer {
            padding: 14px 20px;
            border-top: 1px solid rgba(255,255,255,0.07);
            font-size: 0.7rem;
            color: rgba(255,255,255,0.2);
            text-align: center;
            flex-shrink: 0;
            margin-top: auto;
        }

        /* Sidebar Scroll area */
        .bph-nav-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .bph-nav-scroll::-webkit-scrollbar { width: 3px; }
        .bph-nav-scroll::-webkit-scrollbar-thumb { background: rgba(249,115,22,0.2); }

        /* ============================================================
           NAVBAR (TOP BAR)
        ============================================================ */
        .bph-navbar {
            position: fixed;
            top: 0;
            left: var(--bph-sidebar-w);
            right: 0;
            height: var(--bph-navbar-h);
            background: var(--bph-white);
            border-bottom: 1px solid var(--bph-border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 16px;
            z-index: 1040;
            box-shadow: var(--bph-shadow);
            transition: left var(--bph-transition);
        }

        .bph-navbar-toggle {
            background: none; border: none;
            width: 36px; height: 36px;
            border-radius: var(--bph-radius-sm);
            display: flex; align-items: center; justify-content: center;
            color: var(--bph-muted);
            cursor: pointer;
            transition: all var(--bph-transition);
            flex-shrink: 0;
        }
        .bph-navbar-toggle:hover { background: var(--bph-orange-soft); color: var(--bph-orange); }
        .bph-navbar-toggle i { font-size: 1.15rem; }

        .bph-navbar-welcome {
            flex: 1;
            font-size: 0.88rem; font-weight: 600;
            color: var(--bph-muted);
        }
        .bph-navbar-welcome span { color: var(--bph-orange); font-weight: 800; }

        /* User dropdown in navbar */
        .bph-user-pill {
            display: flex; align-items: center; gap: 10px;
            background: var(--bph-orange-light);
            border: 1.5px solid var(--bph-orange-border);
            border-radius: 40px;
            padding: 5px 14px 5px 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--bph-transition);
        }
        .bph-user-pill:hover { border-color: var(--bph-orange); box-shadow: 0 0 0 3px rgba(249,115,22,0.12); }

        .bph-user-pill-avatar {
            width: 32px; height: 32px;
            border-radius: 50%; object-fit: cover;
            border: 2px solid var(--bph-orange);
        }

        .bph-user-pill-name {
            font-size: 0.82rem; font-weight: 700;
            color: var(--bph-orange-hover);
            max-width: 140px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .bph-user-pill-chevron { font-size: 0.65rem; color: var(--bph-muted); }

        /* Dropdown Menu */
        .bph-dropdown-menu {
            min-width: 230px;
            border: 1px solid var(--bph-border) !important;
            border-radius: var(--bph-radius) !important;
            box-shadow: var(--bph-shadow-lg) !important;
            overflow: hidden;
            margin-top: 8px !important;
            padding: 0 !important;
        }

        .bph-dropdown-head {
            padding: 20px;
            background: linear-gradient(135deg, var(--bph-orange) 0%, var(--bph-orange-hover) 100%);
            text-align: center;
        }
        .bph-dropdown-head img {
            width: 60px; height: 60px;
            border-radius: 50%; object-fit: cover;
            border: 3px solid rgba(255,255,255,0.4);
        }
        .bph-dropdown-head .dn { color: #fff; font-weight: 700; font-size: 0.9rem; margin-top: 8px; }
        .bph-dropdown-head .de { color: rgba(255,255,255,0.75); font-size: 0.75rem; }

        .bph-dropdown-body { padding: 12px; }

        .bph-logout-btn {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%;
            background: var(--bph-orange);
            color: #fff !important;
            border: none; border-radius: var(--bph-radius-sm);
            padding: 9px 0;
            font-size: 0.85rem; font-weight: 700;
            cursor: pointer;
            transition: background var(--bph-transition);
        }
        .bph-logout-btn:hover { background: var(--bph-orange-hover); }

        /* Mobile hamburger (in navbar left area when sidebar is hidden) */
        .bph-mobile-brand {
            display: none;
            align-items: center; gap: 8px;
            text-decoration: none;
        }
        .bph-mobile-brand .t1 { font-size: 1.1rem; font-weight: 800; color: var(--bph-dark); }
        .bph-mobile-brand .t2 { color: var(--bph-orange); }

        /* ============================================================
           MAIN CONTENT AREA
        ============================================================ */
        .bph-content-wrapper {
            margin-left: var(--bph-sidebar-w);
            margin-top: var(--bph-navbar-h);
            min-height: calc(100vh - var(--bph-navbar-h));
            display: flex;
            flex-direction: column;
            transition: margin-left var(--bph-transition);
        }

        .bph-main {
            flex: 1;
            padding: 28px;
            max-width: 100%;
        }

        /* ============================================================
           PAGE HEADER
        ============================================================ */
        .bph-page-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .bph-page-title {
            font-size: 1.35rem; font-weight: 800;
            color: var(--bph-dark); line-height: 1.2;
        }

        .bph-page-subtitle {
            font-size: 0.82rem; color: var(--bph-muted);
            margin-top: 3px;
        }

        .bph-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: 0.75rem; color: var(--bph-muted);
            margin-top: 4px;
        }
        .bph-breadcrumb a { color: var(--bph-orange); text-decoration: none; font-weight: 600; }
        .bph-breadcrumb a:hover { text-decoration: underline; }
        .bph-breadcrumb .sep { color: var(--bph-border); }

        /* ============================================================
           CARD
        ============================================================ */
        .bph-card {
            background: var(--bph-white);
            border-radius: var(--bph-radius);
            border: 1px solid var(--bph-border);
            box-shadow: var(--bph-shadow);
            overflow: hidden;
        }

        .bph-card-head {
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            border-bottom: 1px solid var(--bph-border);
            flex-wrap: wrap; gap: 10px;
        }

        .bph-card-title {
            font-size: 0.95rem; font-weight: 700;
            color: var(--bph-dark);
            display: flex; align-items: center; gap: 8px;
        }
        .bph-card-title i { color: var(--bph-orange); font-size: 1rem; }

        .bph-card-body { padding: 22px; }
        .bph-card-body-flush { padding: 0; }

        /* ============================================================
           STAT / METRIC CARDS
        ============================================================ */
        .bph-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .bph-stat {
            background: var(--bph-white);
            border: 1px solid var(--bph-border);
            border-radius: var(--bph-radius);
            padding: 20px;
            display: flex; align-items: center; gap: 16px;
            box-shadow: var(--bph-shadow);
            transition: transform var(--bph-transition), box-shadow var(--bph-transition);
        }
        .bph-stat:hover { transform: translateY(-2px); box-shadow: var(--bph-shadow-md); }

        .bph-stat-ico {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .bph-ico-orange { background: var(--bph-orange-soft); color: var(--bph-orange); }
        .bph-ico-dark   { background: #F1F5F9; color: #334155; }
        .bph-ico-green  { background: #DCFCE7; color: #15803D; }
        .bph-ico-blue   { background: #DBEAFE; color: #1D4ED8; }

        .bph-stat-lbl  { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--bph-muted); }
        .bph-stat-val  { font-size: 1.75rem; font-weight: 800; color: var(--bph-dark); line-height: 1.15; }
        .bph-stat-sub  { font-size: 0.78rem; color: var(--bph-muted); margin-top: 1px; }

        /* Full action stat card */
        .bph-stat-action {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }
        .bph-stat-action .bph-stat-top { display: flex; align-items: center; gap: 14px; }

        /* ============================================================
           BUTTONS
        ============================================================ */
        .bph-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px;
            border-radius: var(--bph-radius-sm);
            font-size: 0.84rem; font-weight: 700;
            cursor: pointer;
            transition: all var(--bph-transition);
            border: 2px solid transparent;
            text-decoration: none !important;
            white-space: nowrap;
            font-family: inherit;
        }

        .bph-btn-primary  { background: var(--bph-orange); color: #fff !important; border-color: var(--bph-orange); }
        .bph-btn-primary:hover  { background: var(--bph-orange-hover); border-color: var(--bph-orange-hover); color: #fff !important; }

        .bph-btn-outline  { background: transparent; color: var(--bph-text) !important; border-color: var(--bph-border); }
        .bph-btn-outline:hover  { border-color: var(--bph-orange); color: var(--bph-orange) !important; background: var(--bph-orange-light); }

        .bph-btn-danger   { background: #EF4444; color: #fff !important; border-color: #EF4444; }
        .bph-btn-danger:hover   { background: #DC2626; border-color: #DC2626; }

        .bph-btn-success  { background: #22C55E; color: #fff !important; border-color: #22C55E; }
        .bph-btn-success:hover  { background: #16A34A; border-color: #16A34A; }

        .bph-btn-sm { padding: 6px 13px; font-size: 0.78rem; }
        .bph-btn-ico { padding: 7px 9px; }

        /* ============================================================
           TABLE
        ============================================================ */
        .bph-table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }

        .bph-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.86rem;
        }

        .bph-table thead th {
            background: #FAFAFA;
            color: var(--bph-muted);
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 12px 16px;
            border-bottom: 2px solid var(--bph-border);
            white-space: nowrap;
            position: sticky; top: 0;
        }

        .bph-table tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--bph-border);
            vertical-align: middle;
            color: var(--bph-text);
        }

        .bph-table tbody tr:last-child td { border-bottom: none; }
        .bph-table tbody tr:hover { background: var(--bph-orange-light); }
        .bph-table tbody tr:hover td { color: var(--bph-dark); }

        /* ============================================================
           BADGES
        ============================================================ */
        .bph-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem; font-weight: 700;
        }
        .bph-badge-orange { background: var(--bph-orange-soft); color: var(--bph-orange-hover); }
        .bph-badge-green  { background: #DCFCE7; color: #15803D; }
        .bph-badge-red    { background: #FEE2E2; color: #DC2626; }
        .bph-badge-yellow { background: #FEF9C3; color: #A16207; }
        .bph-badge-gray   { background: #F4F4F5; color: #52525B; }

        /* ============================================================
           FORM ELEMENTS
        ============================================================ */
        .bph-form-group { margin-bottom: 20px; }

        .bph-label {
            display: block;
            font-size: 0.84rem; font-weight: 700;
            color: var(--bph-dark);
            margin-bottom: 7px;
        }
        .bph-label .req { color: #EF4444; margin-left: 3px; }

        .bph-input,
        .bph-select,
        .bph-textarea {
            display: block;
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--bph-border);
            border-radius: var(--bph-radius-sm);
            font-size: 0.875rem;
            font-family: 'Manrope', sans-serif;
            color: var(--bph-dark);
            background: var(--bph-white);
            outline: none;
            transition: border-color var(--bph-transition), box-shadow var(--bph-transition);
            -webkit-appearance: none;
        }
        .bph-input:focus,
        .bph-select:focus,
        .bph-textarea:focus {
            border-color: var(--bph-orange);
            box-shadow: 0 0 0 3px rgba(249,115,22,0.13);
        }
        .bph-input::placeholder { color: #A1A1AA; }
        .bph-textarea { resize: vertical; }
        .bph-file-input {
            display: block; width: 100%;
            padding: 8px 12px;
            border: 1.5px dashed var(--bph-border);
            border-radius: var(--bph-radius-sm);
            background: var(--bph-bg);
            font-size: 0.84rem; color: var(--bph-muted);
            cursor: pointer;
            transition: border-color var(--bph-transition);
        }
        .bph-file-input:hover { border-color: var(--bph-orange); }

        .bph-form-hint { font-size: 0.75rem; color: var(--bph-muted); margin-top: 5px; }

        .bph-form-divider { height: 1px; background: var(--bph-border); margin: 22px 0; }

        /* ============================================================
           SEARCH BAR
        ============================================================ */
        .bph-search {
            position: relative;
            display: inline-flex; align-items: center;
        }
        .bph-search-icon {
            position: absolute; left: 11px;
            color: var(--bph-muted); font-size: 0.85rem; pointer-events: none;
        }
        .bph-search-input {
            padding: 9px 14px 9px 34px;
            border: 1.5px solid var(--bph-border);
            border-radius: var(--bph-radius-sm);
            font-size: 0.84rem;
            font-family: 'Manrope', sans-serif;
            color: var(--bph-dark);
            background: var(--bph-white);
            outline: none;
            transition: border-color var(--bph-transition), box-shadow var(--bph-transition);
            width: 240px;
        }
        .bph-search-input:focus { border-color: var(--bph-orange); box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }
        .bph-search-input::placeholder { color: #A1A1AA; }

        /* ============================================================
           PAGINATION
        ============================================================ */
        .bph-pagination {
            display: flex; align-items: center; justify-content: center;
            gap: 4px;
            padding: 16px 22px;
            border-top: 1px solid var(--bph-border);
        }

        .bph-page-btn {
            display: inline-flex; align-items: center; gap: 5px;
            min-width: 36px; height: 36px;
            padding: 0 12px;
            border: 1.5px solid var(--bph-border);
            border-radius: var(--bph-radius-sm);
            font-size: 0.82rem; font-weight: 700;
            color: var(--bph-text);
            text-decoration: none;
            background: var(--bph-white);
            cursor: pointer;
            transition: all var(--bph-transition);
        }
        .bph-page-btn:hover { border-color: var(--bph-orange); color: var(--bph-orange); background: var(--bph-orange-light); }
        .bph-page-btn.active { background: var(--bph-orange); border-color: var(--bph-orange); color: #fff; }
        .bph-page-btn.disabled { opacity: 0.4; pointer-events: none; cursor: default; }

        /* ============================================================
           FOOTER
        ============================================================ */
        .bph-footer {
            padding: 18px 28px;
            border-top: 1px solid var(--bph-border);
            font-size: 0.77rem;
            color: var(--bph-muted);
            background: var(--bph-white);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        /* ============================================================
           EMPTY STATE
        ============================================================ */
        .bph-empty {
            text-align: center;
            padding: 48px 24px;
            color: var(--bph-muted);
        }
        .bph-empty i { font-size: 2.5rem; color: var(--bph-orange-border); display: block; margin-bottom: 10px; }
        .bph-empty p { font-size: 0.88rem; }

        /* ============================================================
           OVERLAY / SIDEBAR BACKDROP (mobile)
        ============================================================ */
        .bph-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1049;
        }
        .bph-overlay.visible { display: block; }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 1024px) {
            .bph-sidebar { transform: translateX(-100%); }
            .bph-sidebar.bph-open { transform: translateX(0); }

            .bph-navbar { left: 0; }
            .bph-content-wrapper { margin-left: 0; }
            .bph-mobile-brand { display: flex; }
            .bph-navbar-welcome { display: none; }
        }

        @media (max-width: 640px) {
            .bph-main { padding: 16px; }
            .bph-page-head { flex-direction: column; align-items: flex-start; }
            .bph-stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .bph-stat-val { font-size: 1.4rem; }
            .bph-search-input { width: 160px; }
            .bph-card-head { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 480px) {
            .bph-stats-grid { grid-template-columns: 1fr; }
        }

        /* ============================================================
           ANIMATIONS
        ============================================================ */
        @keyframes bph-fadein {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .bph-main > * { animation: bph-fadein 0.3s ease both; }
        .bph-main > *:nth-child(2) { animation-delay: 0.05s; }
        .bph-main > *:nth-child(3) { animation-delay: 0.1s; }
        .bph-main > *:nth-child(4) { animation-delay: 0.15s; }

        /* ============================================================
           MISC UTILITIES
        ============================================================ */
        .bph-text-center { text-align: center; }
        .bph-text-muted  { color: var(--bph-muted); }
        .bph-fw-bold     { font-weight: 700; }
        .bph-gap-2       { gap: 8px; }
        .bph-d-flex      { display: flex; }
        .bph-align-center{ align-items: center; }
        .bph-justify-between { justify-content: space-between; }
        .bph-justify-end     { justify-content: flex-end; }
        .bph-flex-wrap   { flex-wrap: wrap; }
        .bph-w-100       { width: 100%; }
    </style>
</head>
<body>

<!-- Sidebar Backdrop (mobile) -->
<div class="bph-overlay" id="bphOverlay"></div>

<!-- SIDEBAR -->
@yield('sidebar')

<!-- NAVBAR -->
@yield('navbar')

<!-- MAIN CONTENT WRAPPER -->
<div class="bph-content-wrapper" id="bphContentWrapper">
    <main class="bph-main">
        @yield('content')
    </main>
    <footer class="bph-footer">
        <i class="bi bi-c-circle" style="color: var(--bph-orange);"></i>
        2024 BioPharm. All rights reserved.
    </footer>
</div>

<!-- Vendor JS -->
<script src="{{ asset('back-end/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('back-end/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('back-end/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('back-end/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('back-end/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('back-end/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('back-end/vendors/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('back-end/vendors/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('back-end/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('back-end/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('back-end/js/off-canvas.js') }}"></script>
<script src="{{ asset('back-end/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('back-end/js/misc.js') }}"></script>
<script src="{{ asset('back-end/js/settings.js') }}"></script>
<script src="{{ asset('back-end/js/todolist.js') }}"></script>
<script src="{{ asset('back-end/js/dashboard.js') }}"></script>

<script>
(function(){
    // Sidebar toggle
    const toggle = document.getElementById('bphToggle');
    const sidebar = document.getElementById('bphSidebar');
    const overlay = document.getElementById('bphOverlay');
    const content = document.getElementById('bphContentWrapper');
    const navbar  = document.getElementById('bphNavbar');

    function openSidebar(){
        sidebar && sidebar.classList.add('bph-open');
        overlay && overlay.classList.add('visible');
    }
    function closeSidebar(){
        sidebar && sidebar.classList.remove('bph-open');
        overlay && overlay.classList.remove('visible');
    }

    if(toggle) toggle.addEventListener('click', function(){
        if(window.innerWidth <= 1024){
            sidebar.classList.contains('bph-open') ? closeSidebar() : openSidebar();
        }
    });

    if(overlay) overlay.addEventListener('click', closeSidebar);

    // Active nav link
    const links = document.querySelectorAll('.bph-nav-link');
    const path = window.location.pathname;
    links.forEach(function(link){
        const href = link.getAttribute('href');
        if(href && href !== '#' && path.includes(href.replace(/.*\//, '/').split('?')[0])){
            link.classList.add('bph-active');
        }
    });
})();
</script>
</body>
</html>
