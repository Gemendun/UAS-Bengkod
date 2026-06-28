{{-- Shared Admin Sidebar Menu --}}
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'menu-open' : '' }}">
      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.dokter.*') ? 'menu-open' : '' }}">
      <a href="{{ route('admin.dokter.index') }}" class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i><p>Kelola Dokter</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.pasien.*') ? 'menu-open' : '' }}">
      <a href="{{ route('admin.pasien.index') }}" class="nav-link {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i><p>Kelola Pasien</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.poli.*') ? 'menu-open' : '' }}">
      <a href="{{ route('admin.poli.index') }}" class="nav-link {{ request()->routeIs('admin.poli.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-hospital-alt"></i><p>Kelola Poli</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.obat.*') ? 'menu-open' : '' }}">
      <a href="{{ route('admin.obat.index') }}" class="nav-link {{ request()->routeIs('admin.obat.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-pills"></i><p>Kelola Obat</p>
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
