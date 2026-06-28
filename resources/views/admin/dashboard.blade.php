@include('layout.header', ['title' => 'Dashboard Admin'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Dashboard Admin</h1>
  </div>

  <section class="content">
    <div class="row">

      <!-- Box: Jumlah Dokter -->
      <div class="col-lg-3 col-md-6 col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $jumlahDokter }}</h3>
            <p>Jumlah Dokter</p>
          </div>
          <div class="icon"><i class="fas fa-user-md"></i></div>
          <a href="{{ route('admin.dokter.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Box: Jumlah Pasien -->
      <div class="col-lg-3 col-md-6 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $jumlahPasien }}</h3>
            <p>Jumlah Pasien</p>
          </div>
          <div class="icon"><i class="fas fa-users"></i></div>
          <a href="{{ route('admin.pasien.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Box: Jumlah Poli -->
      <div class="col-lg-3 col-md-6 col-12">
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{ $jumlahPoli }}</h3>
            <p>Jumlah Poli</p>
          </div>
          <div class="icon"><i class="fas fa-hospital-alt"></i></div>
          <a href="{{ route('admin.poli.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Box: Jumlah Obat -->
      <div class="col-lg-3 col-md-6 col-12">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $jumlahObat }}</h3>
            <p>Jumlah Obat</p>
          </div>
          <div class="icon"><i class="fas fa-pills"></i></div>
          <a href="{{ route('admin.obat.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>
  </section>

@include('layout.footer')