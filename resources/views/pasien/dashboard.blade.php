@include('layout.header', ['title' => 'Dashboard Pasien'])
@include('layout.sidebar_pasien')

  <div class="content-header">
    <h1 class="poli-page-title">Dashboard Pasien</h1>
  </div>

  <section class="content">
    <div class="row">
      <!-- Jumlah Riwayat Periksa -->
      <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $totalRiwayat }}</h3>
            <p>Jumlah Riwayat Periksa</p>
          </div>
          <div class="icon"><i class="fas fa-notes-medical"></i></div>
          <a href="{{ route('periksaPasien') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Dokter Unik -->
      <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $dokterUnik }}</h3>
            <p>Dokter yang Pernah Dikunjungi</p>
          </div>
          <div class="icon"><i class="fas fa-user-md"></i></div>
          <a href="{{ route('periksaPasien') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>

@include('layout.footer')