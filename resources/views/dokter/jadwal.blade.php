@include('layout.header', ['title' => 'Jadwal Periksa'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Jadwal Periksa</h1>
  </div>

  <section class="content">
    @if(session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger mb-3"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="row">
      {{-- Form Tambah Jadwal --}}
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Jadwal Baru</h3>
          </div>
          <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label class="font-weight-bold" style="font-size:12px; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Hari</label>
                <select name="hari" class="form-control" required>
                  <option value="" disabled selected>Pilih hari</option>
                  @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                  <option value="{{ $hari }}">{{ $hari }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="font-weight-bold" style="font-size:12px; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
              </div>
              <div class="form-group mb-0">
                <label class="font-weight-bold" style="font-size:12px; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block">Simpan Jadwal</button>
            </div>
          </form>
        </div>
      </div>

      {{-- Tabel Jadwal --}}
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Jadwal</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Hari</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Status</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($jadwals as $jadwal)
                <tr>
                  <td class="font-weight-bold">{{ $jadwal->hari }}</td>
                  <td>{{ $jadwal->jam_mulai }}</td>
                  <td>{{ $jadwal->jam_selesai }}</td>
                  <td>
                    @if($jadwal->is_aktif)
                      <span class="badge badge-success">Aktif</span>
                    @else
                      <span class="badge" style="background:#f1f5f9;color:#64748b;">Tidak Aktif</span>
                    @endif
                  </td>
                  <td style="text-align:right;">
                    <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @if(!$jadwal->is_aktif)
                    <form action="{{ route('jadwal.aktifkan', $jadwal->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      <button class="btn btn-success btn-sm" onclick="return confirm('Aktifkan jadwal ini?')">Aktifkan</button>
                    </form>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">Belum ada jadwal.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

@include('layout.footer')