@include('layout.header', ['title' => 'Manajemen Obat'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Manajemen Obat</h1>
  </div>

  <section class="content">
    @if(session('success'))
      <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
    @endif

    {{-- Indikator stok menipis / habis --}}
    @php
      $stokHabis   = $obats->filter(fn($o) => $o->stok <= 0);
      $stokMenipis = $obats->filter(fn($o) => $o->stok > 0 && $o->stok <= $o->stok_minimum);
    @endphp

    @if($stokHabis->count() > 0)
      <div class="alert" style="background:#fee2e2;color:#991b1b;border-left:4px solid #ef4444;">
        <i class="fas fa-times-circle mr-2"></i>
        <strong>Stok Habis!</strong> {{ $stokHabis->pluck('nama_obat')->join(', ') }} — Hubungi admin untuk penambahan stok.
      </div>
    @endif

    @if($stokMenipis->count() > 0)
      <div class="alert" style="background:#fef3c7;color:#92400e;border-left:4px solid #f59e0b;">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Stok Menipis!</strong> {{ $stokMenipis->pluck('nama_obat')->join(', ') }} — Segera laporkan ke admin.
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-pills mr-2" style="color:#3b5bdb;"></i>Daftar Obat & Stok</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Obat</th>
              <th>Kemasan</th>
              <th>Harga</th>
              <th>Stok</th>
              <th style="text-align:right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($obats as $obat)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="font-weight-bold">{{ $obat->nama_obat }}</td>
                <td>{{ $obat->kemasan }}</td>
                <td>Rp. {{ number_format($obat->harga, 0, ',', '.') }}</td>
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
                  <button
                    class="btn btn-warning btn-sm"
                    data-toggle="modal"
                    data-target="#editModal"
                    data-id="{{ $obat->id }}"
                    data-nama="{{ $obat->nama_obat }}"
                    data-kemasan="{{ $obat->kemasan }}"
                    data-harga="{{ $obat->harga }}">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                  <button
                    class="btn btn-danger btn-sm btn-delete"
                    data-id="{{ $obat->id }}"
                    data-nama="{{ $obat->nama_obat }}">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>

{{-- Modal Edit Obat --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="" id="formEditObat">
      @csrf
      @method('PUT')
      <div class="modal-content" style="border-radius:14px;overflow:hidden;">
        <div class="modal-header" style="background:#f8fafc;border-bottom:1px solid #f0f3f8;">
          <h5 class="modal-title font-weight-bold" style="color:#1e293b;">Edit Obat</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" id="edit_nama" name="nama_obat" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Kemasan</label>
            <input type="text" id="edit_kemasan" name="kemasan" class="form-control" required>
          </div>
          <div class="form-group mb-0">
            <label>Harga</label>
            <input type="number" id="edit_harga" name="harga" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer" style="background:#f8fafc;border-top:1px solid #f0f3f8;">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

@include('layout.footer')

<script>
  $(document).ready(function() {
    $('#editModal').on('show.bs.modal', function(event) {
      const btn = $(event.relatedTarget);
      $('#edit_nama').val(btn.data('nama'));
      $('#edit_kemasan').val(btn.data('kemasan'));
      $('#edit_harga').val(btn.data('harga'));
      $('#formEditObat').attr('action', '/dokter/obat/' + btn.data('id'));
    });

    $(document).on('click', '.btn-delete', function() {
      if (!confirm('Yakin ingin menghapus obat ' + $(this).data('nama') + '?')) return;
      const id = $(this).data('id');
      const form = $('<form>', { method: 'POST', action: '/dokter/obat/' + id });
      form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
      form.append('<input type="hidden" name="_method" value="DELETE">');
      $('body').append(form);
      form.submit();
    });
  });
</script>