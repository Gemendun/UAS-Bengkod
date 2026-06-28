@include('layout.header', ['title' => 'Daftar Periksa'])
@include('layout.sidebar_pasien')

  <div class="content-header">
    <h1 class="poli-page-title">Daftar Periksa</h1>
  </div>

  <section class="content">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
    @endif

    <div class="row">
      <!-- Form Pendaftaran -->
      <div class="col-md-5">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-clipboard-list mr-2" style="color:#3b5bdb;"></i>Daftar Poli</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('storePeriksa') }}" method="POST">
              @csrf

              <div class="form-group">
                <label>Nomor Rekam Medis</label>
                <input type="text" class="form-control" value="{{ Auth::user()->pasien->no_rm ?? '-' }}" readonly>
              </div>

              <div class="form-group">
                <label>Pilih Jadwal Dokter</label>
                <select name="id_jadwal" class="form-control" required>
                  <option value="">-- Pilih Jadwal Dokter --</option>
                  @foreach ($jadwalDokters as $jadwal)
                    <option value="{{ $jadwal->id }}">
                      {{ $jadwal->dokter->user->nama ?? '-' }} - {{ $jadwal->dokter->poli->nama ?? '-' }}
                      ({{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Keluhan</label>
                <textarea name="keluhan" rows="3" class="form-control"></textarea>
              </div>

              <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Daftar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Riwayat Pendaftaran -->
      <div class="col-md-7">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-history mr-2" style="color:#3b5bdb;"></i>Riwayat Daftar Poli</h3>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover m-0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Poli</th>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Antrian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($periksa as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->jadwal->dokter->poli->nama ?? '-' }}</td>
                      <td>{{ $item->jadwal->dokter->user->nama ?? '-' }}</td>
                      <td>{{ $item->jadwal->hari ?? '-' }}</td>
                      <td>{{ $item->jadwal->jam_mulai ?? '-' }}</td>
                      <td>{{ $item->jadwal->jam_selesai ?? '-' }}</td>
                      <td>{{ $item->nomor_antrian }}</td>
                      <td>
                        @if ($item->status == 'selesai')
                          <span class="badge badge-success">Selesai</span>
                        @else
                          <span class="badge badge-danger">Belum diperiksa</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('periksa.detail', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Lihat</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="9" class="text-center text-muted py-4">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

@include('layout.footer')