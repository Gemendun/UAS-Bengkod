@include('layout.header', ['title' => 'Detail Riwayat - ' . $namaPasien])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <div class="d-flex align-items-center justify-content-between">
      <h1 class="poli-page-title">Riwayat: {{ $namaPasien }}</h1>
      <a href="{{ route('riwayatDokter') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
      </a>
    </div>
    <p class="text-muted mt-1" style="font-size:13px;">Total kunjungan: <strong>{{ $totalKunjungan }}</strong> kali</p>
  </div>

  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Detail Riwayat Pemeriksaan</h3>
      </div>
      <div class="card-body p-0" style="overflow-x:auto;">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Periksa</th>
              <th>Nama Pasien</th>
              <th>Nama Dokter</th>
              <th>Keluhan</th>
              <th>Catatan</th>
              <th>Obat</th>
              <th>Biaya</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($riwayat as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d/m/Y H:i') }}</td>
              <td class="font-weight-bold">{{ $item->pasien->nama }}</td>
              <td>{{ $item->jadwal->dokter->user->nama ?? '-' }}</td>
              <td>{{ $item->keluhan }}</td>
              <td>{{ $item->catatan_dokter ?? '-' }}</td>
              <td>
                @if ($item->obats->isEmpty())
                  <span class="text-muted">Tidak ada</span>
                @else
                  @foreach ($item->obats as $obat)
                    <span class="badge badge-info mr-1">{{ $obat->nama_obat }}</span>
                  @endforeach
                @endif
              </td>
              <td class="font-weight-bold">Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Belum ada riwayat pemeriksaan.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>

@include('layout.footer')