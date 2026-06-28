{{-- resources/views/admin/pasien_edit.blade.php --}}
@include('layout.header', ['title' => 'Edit Pasien'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Edit Data Pasien</h1>
  </div>

  <section class="content">

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
        <h3 class="card-title"><i class="fas fa-user-edit mr-2" style="color:#3b5bdb;"></i>Form Edit Pasien</h3>
      </div>
      <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label>No RM</label>
            <input type="text" class="form-control" value="{{ $pasien->no_rm }}" disabled>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>No KTP</label>
            <input type="text" name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $pasien->alamat) }}</textarea>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $pasien->user->email) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
            <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i>Perbarui</button>
          <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary float-right">Batal</a>
        </div>
      </form>
    </div>

  </section>

@include('layout.footer')
