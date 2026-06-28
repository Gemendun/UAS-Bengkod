@include('layout.header', ['title' => 'Dashboard Dokter'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Dashboard Dokter</h1>
  </div>

  <section class="content">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $totalSelesai }}</h3>
            <p>Pasien Sudah Diperiksa</p>
          </div>
          <div class="icon"><i class="fas fa-user-check"></i></div>
          <a href="{{ route('periksaDokter') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $totalBelum }}</h3>
            <p>Pasien Belum Diperiksa</p>
          </div>
          <div class="icon"><i class="fas fa-user-clock"></i></div>
          <a href="{{ route('periksaDokter') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>1</h3>
            <p>Jadwal Aktif</p>
          </div>
          <div class="icon"><i class="fas fa-calendar-check"></i></div>
          <a href="{{ route('jadwal.index') }}" class="small-box-footer">Lihat Jadwal <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>

@include('layout.footer')