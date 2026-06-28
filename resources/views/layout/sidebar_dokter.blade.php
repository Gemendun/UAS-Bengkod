{{-- Shared Dokter Sidebar Menu --}}
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item {{ request()->routeIs('dashboardDokter') ? 'menu-open' : '' }}">
      <a href="{{ route('dashboardDokter') }}" class="nav-link {{ request()->routeIs('dashboardDokter') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard Dokter</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('jadwal.*') ? 'menu-open' : '' }}">
      <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i><p>Jadwal Periksa</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('periksaDokter') || request()->routeIs('periksa.edit') ? 'menu-open' : '' }}">
      <a href="{{ route('periksaDokter') }}" class="nav-link {{ request()->routeIs('periksaDokter') || request()->routeIs('periksa.edit') ? 'active' : '' }}">
        <i class="nav-icon fas fa-stethoscope"></i><p>Periksa Pasien</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('riwayatDokter') || request()->routeIs('dokter.riwayat.*') ? 'menu-open' : '' }}">
      <a href="{{ route('riwayatDokter') }}" class="nav-link {{ request()->routeIs('riwayatDokter') || request()->routeIs('dokter.riwayat.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-history"></i><p>Riwayat Pasien</p>
      </a>
    </li>
    <li class="nav-item {{ request()->routeIs('dokter.profile.edit') ? 'menu-open' : '' }}">
      <a href="{{ route('dokter.profile.edit') }}" class="nav-link {{ request()->routeIs('dokter.profile.edit') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-circle"></i><p>Profil Saya</p>
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
