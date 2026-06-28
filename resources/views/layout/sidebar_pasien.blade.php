{{-- Shared Pasien Sidebar Menu --}}
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item {{ request()->routeIs('dashboardPasien') ? 'menu-open' : '' }}">
      <a href="{{ route('dashboardPasien') }}" class="nav-link {{ request()->routeIs('dashboardPasien') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('periksaPasien') ? 'menu-open' : '' }}">
      <a href="{{ route('periksaPasien') }}" class="nav-link {{ request()->routeIs('periksaPasien') ? 'active' : '' }}">
        <i class="nav-icon fas fa-notes-medical"></i><p>Daftar Periksa</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('periksa.detail') ? 'menu-open' : '' }}">
      <a href="{{ route('periksaPasien') }}" class="nav-link {{ request()->routeIs('periksa.detail') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-medical-alt"></i><p>Riwayat Periksa</p>
      </a>
    </li>
  </ul>
</nav>

<div class="poli-logout-area">
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
  <button class="poli-logout-btn" onclick="document.getElementById('logout-form').submit()">
    <i class="fas fa-sign-out-alt"></i> Keluar
  </button>
</div>

</div>{{-- /.sidebar --}}
</aside>{{-- /.main-sidebar --}}

<div class="content-wrapper">
