@include('layout.header', ['title' => 'Riwayat Periksa'])
@include('layout.sidebar_pasien')

  <div class="content-header">
    <h1 class="poli-page-title">Riwayat Periksa</h1>
  </div>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-file-medical-alt mr-2" style="color:#3b5bdb;"></i>Riwayat Periksa</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Dokter</th>
              <th>Tanggal Periksa</th>
              <th>Biaya Periksa</th>
              <th style="text-align:right;">Detail</th>
            </tr>
          </thead>
          <tbody>
            @forelse($riwayat as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->jadwal->dokter->user->nama ?? '-' }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d-m-Y') }}</td>
              <td><span class="badge badge-success">Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</span></td>
              <td style="text-align:right;">
                <a href="{{ route('periksa.detail', $item->id) }}" class="btn btn-info btn-sm">
                  <i class="fas fa-eye"></i> Detail
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat periksa.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>

@include('layout.footer')
