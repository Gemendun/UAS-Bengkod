@include('layout.header', ['title' => 'Edit Obat'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Edit Obat</h1>
  </div>

  <section class="content">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-pills mr-2" style="color:#3b5bdb;"></i>Form Edit Obat</h3>
          </div>
          <form method="POST" action="{{ route('dokter.obatUpdate', $obat->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label>Nama Obat</label>
                <input value="{{ $obat->nama_obat }}" type="text" name="nama_obat" class="form-control" placeholder="Nama obat" required>
              </div>
              <div class="form-group">
                <label>Kemasan</label>
                <input value="{{ $obat->kemasan }}" type="text" name="kemasan" class="form-control" placeholder="Kemasan" required>
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input value="{{ $obat->harga }}" type="number" name="harga" class="form-control" placeholder="Harga" required>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-1"></i>Update Obat</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@include('layout.footer')
