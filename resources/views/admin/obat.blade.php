{{-- resources/views/admin/obat.blade.php --}}
@include('layout.header', ['title' => 'Kelola Obat'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Kelola Obat</h1>
  </div>

  <section class="content">

    {{-- Notifikasi --}}
    @if (session('success'))
      <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
      </div>
    @endif

    {{-- Indikator stok menipis / habis --}}
    @php
      $stokHabis   = $obats->filter(fn($o) => $o->stok <= 0);
      $stokMenipis = $obats->filter(fn($o) => $o->stok > 0 && $o->stok <= $o->stok_minimum);
    @endphp

    @if($stokHabis->count() > 0)
      <div class="alert" style="background:#fee2e2;color:#991b1b;border-left:4px solid #ef4444;">
        <i class="fas fa-times-circle mr-2"></i>
        <strong>Stok Habis!</strong>
        Obat berikut stoknya sudah habis:
        <strong>{{ $stokHabis->pluck('nama_obat')->join(', ') }}</strong>
        — Segera lakukan penambahan stok.
      </div>
    @endif

    @if($stokMenipis->count() > 0)
      <div class="alert" style="background:#fef3c7;color:#92400e;border-left:4px solid #f59e0b;">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Stok Menipis!</strong>
        Obat berikut stoknya hampir habis:
        <strong>{{ $stokMenipis->pluck('nama_obat')->join(', ') }}</strong>
        — Segera tambahkan stok.
      </div>
    @endif

    <div class="row">
      <!-- Form Tambah Obat -->
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Obat Baru</h3>
          </div>
          <form action="{{ route('admin.obat.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" required value="{{ old('nama_obat') }}">
              </div>
              <div class="form-group">
                <label>Kemasan</label>
                <input type="text" name="kemasan" class="form-control" required value="{{ old('kemasan') }}">
              </div>
              <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
              </div>
              <div class="form-group">
                <label>Stok Awal</label>
                <input type="number" name="stok" class="form-control" required value="{{ old('stok', 0) }}" min="0">
              </div>
              <div class="form-group mb-0">
                <label>Stok Minimum <small class="text-muted">(batas peringatan menipis)</small></label>
                <input type="number" name="stok_minimum" class="form-control" required value="{{ old('stok_minimum', 5) }}" min="1">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus mr-1"></i>Simpan</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Obat -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-pills mr-2" style="color:#3b5bdb;"></i>Daftar Obat & Stok</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Obat</th>
                  <th>Kemasan</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($obats as $obat)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-weight-bold">{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kemasan }}</td>
                    <td>Rp{{ number_format($obat->harga, 0, ',', '.') }}</td>
                    <td>
                      @if($obat->stok <= 0)
                        <span class="badge" style="background:#fee2e2;color:#991b1b;font-size:12px;padding:5px 10px;">
                          <i class="fas fa-times-circle mr-1"></i>HABIS
                        </span>
                      @elseif($obat->stok <= $obat->stok_minimum)
                        <span class="badge" style="background:#fef3c7;color:#92400e;font-size:12px;padding:5px 10px;">
                          <i class="fas fa-exclamation-triangle mr-1"></i>{{ $obat->stok }} (Menipis)
                        </span>
                      @else
                        <span class="badge" style="background:#dcfce7;color:#166534;font-size:12px;padding:5px 10px;">
                          <i class="fas fa-check-circle mr-1"></i>{{ $obat->stok }}
                        </span>
                      @endif
                    </td>
                    <td style="text-align:right;">
                      {{-- Tombol Tambah Stok --}}
                      <button class="btn btn-success btn-sm"
                        data-toggle="modal" data-target="#modalTambahStok"
                        data-id="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-stok="{{ $obat->stok }}">
                        <i class="fas fa-plus"></i> Stok
                      </button>
                      {{-- Tombol Kurangi Stok --}}
                      <button class="btn btn-warning btn-sm"
                        data-toggle="modal" data-target="#modalKurangiStok"
                        data-id="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-stok="{{ $obat->stok }}">
                        <i class="fas fa-minus"></i> Stok
                      </button>
                      <a href="{{ route('admin.obat.edit', $obat->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                      <form action="{{ route('admin.obat.destroy', $obat->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data obat.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>

{{-- Modal Tambah Stok --}}
<div class="modal fade" id="modalTambahStok" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form method="POST" action="" id="formTambahStok">
      @csrf
      <div class="modal-content" style="border-radius:14px;overflow:hidden;">
        <div class="modal-header" style="background:#dcfce7;border-bottom:1px solid #bbf7d0;">
          <h5 class="modal-title" style="color:#166534;"><i class="fas fa-plus-circle mr-2"></i>Tambah Stok</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <p class="text-muted mb-2" id="infTambahNama"></p>
          <p class="mb-3">Stok saat ini: <strong id="infTambahStok"></strong></p>
          <div class="form-group mb-0">
            <label>Jumlah yang Ditambahkan</label>
            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save mr-1"></i>Tambah Stok</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Modal Kurangi Stok --}}
<div class="modal fade" id="modalKurangiStok" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form method="POST" action="" id="formKurangiStok">
      @csrf
      <div class="modal-content" style="border-radius:14px;overflow:hidden;">
        <div class="modal-header" style="background:#fef3c7;border-bottom:1px solid #fde68a;">
          <h5 class="modal-title" style="color:#92400e;"><i class="fas fa-minus-circle mr-2"></i>Kurangi Stok</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <p class="text-muted mb-2" id="infKurangiNama"></p>
          <p class="mb-3">Stok saat ini: <strong id="infKurangiStok"></strong></p>
          <div class="form-group mb-0">
            <label>Jumlah yang Dikurangi</label>
            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-save mr-1"></i>Kurangi Stok</button>
        </div>
      </div>
    </form>
  </div>
</div>

@include('layout.footer')

<script>
  // Modal Tambah Stok
  $(document).ready(function() {
    $('#modalTambahStok').on('show.bs.modal', function(event) {
      const btn = $(event.relatedTarget);
      $('#infTambahNama').text('Obat: ' + btn.data('nama'));
      $('#infTambahStok').text(btn.data('stok') + ' unit');
      $('#formTambahStok').attr('action', '/admin/obat/' + btn.data('id') + '/tambah-stok');
    });
    // Modal Kurangi Stok
    $('#modalKurangiStok').on('show.bs.modal', function(event) {
      const btn = $(event.relatedTarget);
      $('#infKurangiNama').text('Obat: ' + btn.data('nama'));
      $('#infKurangiStok').text(btn.data('stok') + ' unit');
      $('#formKurangiStok').attr('action', '/admin/obat/' + btn.data('id') + '/kurangi-stok');
    });
  });
</script>
