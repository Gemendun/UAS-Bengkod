{{-- resources/views/admin/obat_edit.blade.php --}}
@include('layout.header', ['title' => 'Edit Obat'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Edit Obat</h1>
  </div>

  <section class="content">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-pills mr-2" style="color:#3b5bdb;"></i>Form Edit Obat</h3>
      </div>
      <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Kemasan</label>
            <input type="text" name="kemasan" value="{{ old('kemasan', $obat->kemasan) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" value="{{ old('harga', $obat->harga) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Stok Saat Ini</label>
            <input type="number" name="stok" value="{{ old('stok', $obat->stok) }}" class="form-control" required min="0">
            <small class="text-muted">Untuk tambah/kurangi stok secara manual, gunakan tombol stok di halaman daftar obat.</small>
          </div>
          <div class="form-group mb-0">
            <label>Stok Minimum <small class="text-muted">(batas peringatan menipis)</small></label>
            <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $obat->stok_minimum) }}" class="form-control" required min="1">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i>Update</button>
          <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary float-right">Batal</a>
        </div>
      </form>
    </div>

  </section>

@include('layout.footer')
