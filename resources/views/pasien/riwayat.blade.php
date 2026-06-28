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
            {{-- Jika pakai data dinamis, ganti dengan @forelse --}}
            <tr>
              <td>1</td>
              <td>dr. Andi</td>
              <td>10-04-2025</td>
              <td><span class="badge badge-success">Rp 150.000</span></td>
              <td style="text-align:right;">
                <a href="#" data-toggle="modal" data-target="#modalDetail1" class="btn btn-info btn-sm">
                  <i class="fas fa-eye"></i> Detail
                </a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>dr. Budi</td>
              <td>11-04-2025</td>
              <td><span class="badge badge-danger">Belum Ada</span></td>
              <td style="text-align:right;">
                <a href="#" data-toggle="modal" data-target="#modalDetail2" class="btn btn-info btn-sm">
                  <i class="fas fa-eye"></i> Detail
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Detail 1 -->
    <div class="modal fade" id="modalDetail1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Pemeriksaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>Dokter:</strong> dr. Andi</p>
            <p><strong>Tanggal Periksa:</strong> 10-04-2025 10:00</p>
            <p><strong>Biaya:</strong> Rp 150.000</p>
            <p><strong>Catatan:</strong> Pasien mengalami flu ringan</p>
            <p><strong>Obat:</strong></p>
            <ul>
              <li>Paracetamol | Tablet 500mg</li>
              <li>Vitamin C | Tablet 100mg</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Detail 2 -->
    <div class="modal fade" id="modalDetail2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Pemeriksaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>Dokter:</strong> dr. Budi</p>
            <p><strong>Tanggal Periksa:</strong> 11-04-2025 14:30</p>
            <p><strong>Biaya:</strong> <span class="text-danger">Belum Diinput</span></p>
            <p><strong>Catatan:</strong> <span class="text-danger">Belum Ada Catatan</span></p>
            <p><strong>Obat:</strong></p>
            <ul><li>-</li></ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

  </section>

@include('layout.footer')
