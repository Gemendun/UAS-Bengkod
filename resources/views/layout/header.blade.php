<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik | {{ $title ?? 'Dashboard' }}</title>

  <!-- Google Font: Instrument Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- AdminLTE Theme -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css') }}">

  <style>
    /* =============================================
       GLOBAL FONT OVERRIDE
    ============================================= */
    *, body {
      font-family: 'Instrument Sans', sans-serif !important;
    }

    /* =============================================
       BODY / WRAPPER
    ============================================= */
    body.hold-transition.sidebar-mini.layout-fixed {
      background-color: #f1f4f9 !important;
    }
    .wrapper {
      background-color: #f1f4f9 !important;
    }

    /* =============================================
       SIDEBAR
    ============================================= */
    .main-sidebar {
      background: linear-gradient(180deg, #1b3074 0%, #19296a 100%) !important;
      border: none !important;
      box-shadow: 4px 0 20px rgba(27, 48, 116, 0.15) !important;
      width: 235px !important;
    }

    .main-sidebar .sidebar {
      overflow-x: hidden;
    }

    /* Brand Header */
    .poli-brand {
      padding: 22px 18px 18px 18px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .poli-brand-row {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .poli-brand-icon {
      width: 34px;
      height: 34px;
      background: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .poli-brand-name {
      font-size: 17px;
      font-weight: 700;
      color: #ffffff;
      letter-spacing: 0.01em;
    }

    .poli-brand-badge {
      margin-top: 8px;
      margin-left: 44px;
      display: inline-block;
      padding: 2px 10px;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.18);
      border-radius: 99px;
      color: #c7d2f8;
      font-size: 9px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    /* Sidebar Menu Section Header */
    .poli-sidebar-header {
      padding: 20px 18px 6px 18px;
      font-size: 10px;
      font-weight: 700;
      color: rgba(255,255,255,0.35);
      letter-spacing: 0.1em;
      text-transform: uppercase;
      user-select: none;
    }

    /* Nav Items */
    .sidebar .nav-sidebar {
      padding: 0 10px 10px 10px !important;
    }

    .sidebar .nav-sidebar .nav-link {
      color: rgba(255,255,255,0.65) !important;
      padding: 11px 14px !important;
      font-size: 13.5px !important;
      font-weight: 500 !important;
      border-radius: 10px !important;
      margin-bottom: 3px !important;
      border: 1px solid transparent !important;
      transition: all 0.18s ease !important;
      display: flex !important;
      align-items: center !important;
      gap: 0 !important;
      background: transparent !important;
    }

    .sidebar .nav-sidebar .nav-link i,
    .sidebar .nav-sidebar .nav-link .nav-icon {
      font-size: 15px !important;
      width: 22px !important;
      text-align: center !important;
      color: rgba(255,255,255,0.55) !important;
      margin-right: 12px !important;
      flex-shrink: 0;
    }

    .sidebar .nav-sidebar .nav-link p {
      margin: 0 !important;
      font-size: 13.5px !important;
      font-weight: 500 !important;
      white-space: nowrap;
    }

    .sidebar .nav-sidebar .nav-link:hover {
      background: rgba(255,255,255,0.07) !important;
      color: #fff !important;
    }

    .sidebar .nav-sidebar .nav-link:hover i,
    .sidebar .nav-sidebar .nav-link:hover .nav-icon {
      color: #fff !important;
    }

    .sidebar .nav-sidebar .nav-link.active {
      background: rgba(255,255,255,0.1) !important;
      border: 1px solid rgba(255,255,255,0.2) !important;
      color: #fff !important;
    }

    .sidebar .nav-sidebar .nav-link.active i,
    .sidebar .nav-sidebar .nav-link.active .nav-icon {
      color: #fff !important;
    }

    /* Logout Button */
    .poli-logout-area {
      padding: 12px 10px 16px 10px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }

    .poli-logout-btn {
      background: #e74c5e !important;
      border: none !important;
      border-radius: 10px !important;
      color: #fff !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      padding: 11px 14px !important;
      width: 100%;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: background 0.18s ease;
    }

    .poli-logout-btn:hover {
      background: #c93d50 !important;
    }

    .poli-logout-btn i {
      font-size: 15px;
    }

    /* =============================================
       TOP NAVBAR
    ============================================= */
    .main-header.navbar {
      background: #ffffff !important;
      border-bottom: 1px solid #e8ecf0 !important;
      height: 62px !important;
      margin-left: 235px !important;
      padding: 0 28px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
      position: fixed !important;
      top: 0;
      right: 0;
      left: 0;
      z-index: 1029;
    }

    .poli-breadcrumb {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .poli-breadcrumb-home {
      font-size: 13px;
      font-weight: 600;
      color: #3b5bdb !important;
      text-decoration: none;
      transition: color 0.15s;
    }

    .poli-breadcrumb-home:hover {
      color: #1a36b0 !important;
    }

    .poli-breadcrumb-sep {
      color: #cbd5e1;
      font-size: 13px;
    }

    .poli-breadcrumb-current {
      font-size: 13px;
      font-weight: 600;
      color: #334155;
    }

    .poli-navbar-right {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .poli-navbar-fullscreen {
      color: #94a3b8;
      font-size: 16px;
      cursor: pointer;
      transition: color 0.15s;
      background: none;
      border: none;
      padding: 0;
      line-height: 1;
    }

    .poli-navbar-fullscreen:hover { color: #475569; }

    .poli-user-info {
      text-align: right;
      line-height: 1.3;
    }

    .poli-user-name {
      font-size: 13px;
      font-weight: 700;
      color: #1e293b;
    }

    .poli-user-role {
      font-size: 10px;
      font-weight: 600;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }

    .poli-user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: #6366f1;
      color: #fff;
      font-size: 13px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    /* =============================================
       CONTENT WRAPPER
    ============================================= */
    .content-wrapper {
      margin-left: 235px !important;
      margin-top: 62px !important;
      background: #f1f4f9 !important;
      padding: 28px 30px !important;
      min-height: calc(100vh - 62px) !important;
    }

    /* Content Header */
    .content-header {
      padding: 0 0 16px 0 !important;
    }

    .content-header h1,
    .content-header .poli-page-title {
      font-size: 22px !important;
      font-weight: 700 !important;
      color: #1e293b !important;
      margin: 0 !important;
    }

    /* Hide AdminLTE breadcrumb in content-header (we use navbar) */
    .content-header ol.breadcrumb {
      display: none !important;
    }

    /* =============================================
       CARDS
    ============================================= */
    .card {
      background: #ffffff !important;
      border: none !important;
      border-radius: 16px !important;
      box-shadow: 0 2px 12px rgba(0,0,0,0.04) !important;
      margin-bottom: 20px !important;
      overflow: visible !important;
    }

    .card-header {
      background: #ffffff !important;
      border-bottom: 1px solid #f0f3f8 !important;
      padding: 18px 22px !important;
      border-radius: 16px 16px 0 0 !important;
    }

    .card-header.bg-success, .card-header.bg-info,
    .card-header.bg-primary, .card-header.bg-warning,
    .card-header.bg-danger {
      background: #ffffff !important;
      color: #1e293b !important;
      border-bottom: 1px solid #f0f3f8 !important;
    }

    .card-title {
      font-size: 15px !important;
      font-weight: 700 !important;
      color: #1e293b !important;
    }

    .card-body {
      padding: 20px 22px !important;
    }

    .card-footer {
      background: #f8fafc !important;
      border-top: 1px solid #f0f3f8 !important;
      padding: 14px 22px !important;
      border-radius: 0 0 16px 16px !important;
    }

    /* =============================================
       STAT BOXES (Small Boxes)
    ============================================= */
    .small-box {
      border-radius: 14px !important;
      overflow: hidden !important;
      box-shadow: 0 4px 16px rgba(0,0,0,0.06) !important;
    }

    .small-box.bg-info { background: linear-gradient(135deg, #3b82f6, #2563eb) !important; }
    .small-box.bg-success { background: linear-gradient(135deg, #10b981, #059669) !important; }
    .small-box.bg-warning { background: linear-gradient(135deg, #f59e0b, #d97706) !important; }
    .small-box.bg-danger { background: linear-gradient(135deg, #ef4444, #dc2626) !important; }
    .small-box.bg-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important; }

    .small-box > .inner h3 {
      font-size: 36px !important;
      font-weight: 700 !important;
    }

    .small-box > .inner p {
      font-size: 13px !important;
      font-weight: 500 !important;
    }

    .small-box-footer {
      background: rgba(0,0,0,0.1) !important;
      font-size: 12px !important;
      font-weight: 600 !important;
    }

    /* =============================================
       TABLES
    ============================================= */
    .table {
      margin: 0 !important;
    }

    .table thead th {
      border: none !important;
      border-bottom: 1px solid #f0f3f8 !important;
      background: #f8fafc !important;
      color: #64748b !important;
      font-size: 11px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.07em !important;
      padding: 14px 18px !important;
    }

    .table tbody td {
      border: none !important;
      border-bottom: 1px solid #f5f7fb !important;
      padding: 15px 18px !important;
      font-size: 13.5px !important;
      color: #334155 !important;
      vertical-align: middle !important;
    }

    .table tbody tr:last-child td {
      border-bottom: none !important;
    }

    .table tbody tr:hover td {
      background: #f8fafc !important;
    }

    /* =============================================
       BUTTONS
    ============================================= */
    .btn {
      border-radius: 8px !important;
      font-weight: 600 !important;
      font-size: 12.5px !important;
      transition: all 0.18s ease !important;
    }

    .btn-sm {
      padding: 6px 14px !important;
      font-size: 12px !important;
    }

    .btn-primary {
      background: #3b5bdb !important;
      border-color: #3b5bdb !important;
    }
    .btn-primary:hover { background: #2f4ac5 !important; border-color: #2f4ac5 !important; }

    .btn-info {
      background: #2563eb !important;
      border-color: #2563eb !important;
      color: #fff !important;
    }
    .btn-info:hover { background: #1d4ed8 !important; border-color: #1d4ed8 !important; }

    .btn-success {
      background: #059669 !important;
      border-color: #059669 !important;
    }
    .btn-success:hover { background: #047857 !important; border-color: #047857 !important; }

    .btn-warning {
      background: #f59e0b !important;
      border-color: #f59e0b !important;
      color: #fff !important;
    }
    .btn-warning:hover { background: #d97706 !important; border-color: #d97706 !important; color: #fff !important; }

    .btn-danger {
      background: #ef4444 !important;
      border-color: #ef4444 !important;
    }
    .btn-danger:hover { background: #dc2626 !important; border-color: #dc2626 !important; }

    .btn-secondary {
      background: #94a3b8 !important;
      border-color: #94a3b8 !important;
      color: #fff !important;
    }

    .btn-block { border-radius: 10px !important; }

    /* =============================================
       FORM CONTROLS
    ============================================= */
    .form-control {
      border: 1px solid #e2e8f0 !important;
      border-radius: 10px !important;
      font-size: 13.5px !important;
      color: #334155 !important;
      padding: 10px 14px !important;
      background: #f8fafc !important;
      transition: all 0.18s;
    }
    .form-control:focus {
      border-color: #6366f1 !important;
      background: #ffffff !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
    }

    /* =============================================
       ALERTS
    ============================================= */
    .alert {
      border-radius: 10px !important;
      border: none !important;
      font-size: 13.5px !important;
    }
    .alert-success { background: #dcfce7 !important; color: #166534 !important; }
    .alert-danger { background: #fee2e2 !important; color: #991b1b !important; }
    .alert-warning { background: #fef3c7 !important; color: #92400e !important; }

    /* =============================================
       FOOTER
    ============================================= */
    .main-footer {
      margin-left: 235px !important;
      border-top: 1px solid #e8ecf0 !important;
      background: #f1f4f9 !important;
      color: #94a3b8 !important;
      font-size: 12px !important;
      padding: 14px 28px !important;
    }

    .main-footer a {
      color: #3b5bdb !important;
      font-weight: 600;
    }

    /* =============================================
       PRELOADER HIDE
    ============================================= */
    .preloader { display: none !important; }

    /* =============================================
       BADGE OVERRIDE
    ============================================= */
    .badge {
      border-radius: 6px !important;
      font-size: 11px !important;
      font-weight: 600 !important;
    }
    .badge-success { background: #dcfce7 !important; color: #166534 !important; }
    .badge-warning { background: #fef3c7 !important; color: #92400e !important; }
    .badge-danger { background: #fee2e2 !important; color: #991b1b !important; }
    .badge-info { background: #dbeafe !important; color: #1e40af !important; }
    .badge-primary { background: #e0e7ff !important; color: #3730a3 !important; }

    /* Table striped remove */
    .table-striped tbody tr:nth-of-type(odd) { background-color: transparent !important; }
    .table-bordered { border: none !important; }
    .table-bordered td, .table-bordered th { border: none !important; border-bottom: 1px solid #f5f7fb !important; }
    .table-hover tbody tr:hover { background-color: #f8fafc !important; }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- TOP NAVBAR -->
  <nav class="main-header navbar navbar-expand">
    <div class="poli-breadcrumb">
      <a href="#" class="poli-breadcrumb-home">Poliklinik</a>
      <span class="poli-breadcrumb-sep">/</span>
      <span class="poli-breadcrumb-current">{{ $title ?? 'Dashboard' }}</span>
    </div>

    <div class="poli-navbar-right ml-auto">
      <a class="poli-navbar-fullscreen" data-widget="fullscreen" href="#" role="button" title="Layar Penuh">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
      <div class="poli-user-info">
        <div class="poli-user-name">{{ Auth::user()->nama }}</div>
        <div class="poli-user-role">{{ Auth::user()->role }}</div>
      </div>
      <div class="poli-user-avatar">
        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
      </div>
    </div>
  </nav>
  <!-- END NAVBAR -->

  <!-- SIDEBAR -->
  <aside class="main-sidebar elevation-0">
    <div class="poli-brand">
      <div class="poli-brand-row">
        <div class="poli-brand-icon">
          <svg width="22" height="22" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="42" stroke="#1b3074" stroke-width="8"/>
            <path d="M38 28V72H52C61.4 72 69 64.4 69 55C69 45.6 61.4 38 52 38H38" stroke="#1b3074" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M48 48V62M48 55H52L57 48M52 55L57 62" stroke="#1b3074" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <span class="poli-brand-name">Poliklinik</span>
      </div>
      <span class="poli-brand-badge">{{ Auth::user()->role }}</span>
    </div>

    <div class="sidebar">
      <p class="poli-sidebar-header">Menu {{ Auth::user()->role }}</p>