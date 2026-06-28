@include('layout.header', ['title' => 'Periksa Pasien'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Periksa Pasien</h1>
  </div>

  <section class="content">
    @if(session('success'))
      <div class="alert alert-success mb-3"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger mb-3"><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-stethoscope mr-2" style="color:#3b5bdb;"></i>Data Antrian Pasien</h3>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No Antrian</th>
              <th>Nama Pasien</th>
              <th>Keluhan</th>
              <th>Status</th>
              <th style="text-align:right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($periksa as $item)
              <tr>
                <td><span class="badge badge-primary">{{ $item->nomor_antrian }}</span></td>
                <td class="font-weight-bold">{{ $item->pasien->nama }}</td>
                <td>{{ $item->keluhan ?? '-' }}</td>
                <td>
                  @if($item->status === 'selesai')
                    <span class="badge badge-success">Selesai</span>
                  @else
                    <span class="badge badge-warning">Menunggu</span>
                  @endif
                </td>
                <td style="text-align:right;">
                  <button class="btn btn-sm {{ $item->status === 'selesai' ? 'btn-warning' : 'btn-info' }}"
                    data-toggle="modal"
                    data-target="#editModal"
                    data-id="{{ $item->id }}"
                    data-nama="{{ $item->pasien->nama }}"
                    data-tgl="{{ $item->tgl_periksa }}"
                    data-keluhan="{{ $item->keluhan }}"
                    data-catatan="{{ $item->catatan_dokter }}"
                    data-biaya="{{ $item->biaya_periksa }}">
                    <i class="fas fa-{{ $item->status === 'selesai' ? 'edit' : 'stethoscope' }}"></i>
                    {{ $item->status === 'selesai' ? 'Edit' : 'Periksa' }}
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-4">Belum ada antrian pasien hari ini.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>

{{-- Modal Pemeriksaan --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="" id="formEditPeriksa">@csrf @method('PUT')
      <div class="modal-content" style="border-radius:16px; overflow:hidden; border:none; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
        <div class="modal-header" style="background:#f8fafc; border-bottom:1px solid #f0f3f8;">
          <h5 class="modal-title font-weight-bold" style="color:#1e293b;">Form Pemeriksaan Pasien</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;">Nama Pasien</label>
            <input type="text" id="nama" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;">Tanggal Periksa</label>
            <input type="text" id="tgl_periksa" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;">Keluhan</label>
            <textarea id="keluhan" class="form-control" rows="2" readonly></textarea>
          </div>
          <div class="form-group">
            <label style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;">Catatan Dokter</label>
            <textarea name="catatan_dokter" id="catatan_dokter" class="form-control" rows="3" placeholder="Isi catatan dokter..."></textarea>
          </div>
          <div class="form-group">
            <label style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;">Pilih Obat Resep</label>
            <select id="obat" class="form-control">
              <option value="">-- Pilih Obat --</option>
              @foreach ($obats as $obat)
                @if($obat->stok <= 0)
                  <option value="{{ $obat->id }}" disabled style="color:#dc2626;background:#fee2e2;">
                    {{ $obat->nama_obat }} — STOK HABIS
                  </option>
                @elseif($obat->stok <= $obat->stok_minimum)
                  <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-harga="{{ $obat->harga }}" data-stok="{{ $obat->stok }}" style="color:#92400e;">
                    ⚠ {{ $obat->nama_obat }} - Rp. {{ number_format($obat->harga) }} (Stok: {{ $obat->stok }} - Menipis)
                  </option>
                @else
                  <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-harga="{{ $obat->harga }}" data-stok="{{ $obat->stok }}">
                    {{ $obat->nama_obat }} - Rp. {{ number_format($obat->harga) }} (Stok: {{ $obat->stok }})
                  </option>
                @endif
              @endforeach
            </select>
            <div id="stokWarning" class="mt-1" style="display:none;color:#92400e;font-size:12px;"></div>
          </div>
          <ul class="list-group mb-3" id="listObat"></ul>
          <div class="form-group mb-0">
            <label style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.05em;">Total Biaya</label>
            <input type="text" id="biaya_periksa_view" class="form-control" readonly>
            <input type="hidden" name="biaya_periksa" id="biaya_periksa">
          </div>
        </div>
        <div class="modal-footer" style="background:#f8fafc; border-top:1px solid #f0f3f8;">
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
    let hargaPemeriksaan = 150000;
    let totalObat = 0;

    function updateTotal() {
      const total = hargaPemeriksaan + totalObat;
      $('#biaya_periksa').val(total);
      $('#biaya_periksa_view').val('Rp. ' + total.toLocaleString('id-ID'));
    }

    $('#editModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      const modal = $(this);
      modal.find('#nama').val(button.data('nama'));
      modal.find('#tgl_periksa').val(button.data('tgl'));
      modal.find('#keluhan').val(button.data('keluhan'));
      modal.find('#catatan_dokter').val(button.data('catatan'));
      modal.find('#biaya_periksa_view').val('Rp. ' + parseInt(button.data('biaya')).toLocaleString('id-ID'));
      modal.find('#biaya_periksa').val(button.data('biaya'));
      $('#listObat').empty();
      totalObat = 0;
      updateTotal();
      modal.find('#formEditPeriksa').attr('action', '/dokter/periksa/' + button.data('id'));
    });

    $('#obat').on('change', function() {
      const selected = $('#obat option:selected');
      const id = selected.val();
      const nama = selected.data('nama');
      const harga = parseInt(selected.data('harga')) || 0;
      const stok = parseInt(selected.data('stok')) || 0;

      // Tampilkan warning jika stok menipis
      if (id && stok <= 5 && stok > 0) {
        $('#stokWarning').show().html('<i class="fas fa-exclamation-triangle mr-1"></i>Perhatian: stok ' + nama + ' hanya tersisa ' + stok + ' unit.');
      } else {
        $('#stokWarning').hide();
      }

      if (id && !$('#obat-item-' + id).length) {
        const html = `<li class="list-group-item d-flex justify-content-between align-items-center" id="obat-item-${id}" style="border-radius:10px;margin-bottom:6px;border:1px solid #f0f3f8;">
          <span>${nama} <span class="text-muted" style="font-size:12px;">Rp. ${harga.toLocaleString('id-ID')}</span></span>
          <input type="hidden" name="obats[]" value="${id}">
          <button type="button" class="btn btn-danger btn-sm btnHapusObat" data-id="${id}" data-harga="${harga}"><i class="fas fa-times"></i></button>
        </li>`;
        $('#listObat').append(html);
        totalObat += harga;
        updateTotal();
      }
    });

    $(document).on('click', '.btnHapusObat', function() {
      const id = $(this).data('id');
      const harga = parseInt($(this).data('harga')) || 0;
      $('#obat-item-' + id).remove();
      totalObat -= harga;
      updateTotal();
    });
  });
</script>