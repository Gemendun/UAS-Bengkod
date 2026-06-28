{{-- resources/views/admin/pasien.blade.php --}}
@include('layout.header', ['title' => 'Kelola Pasien'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Kelola Pasien</h1>
  </div>

  <section class="content">

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
      <!-- Form Tambah Pasien -->
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header"><h3 class="card-title">Tambah Pasien</h3></div>
          <form action="{{ route('admin.pasien.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label>No KTP</label>
                <input type="text" name="no_ktp" class="form-control" required>
              </div>
              <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Pasien -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-users mr-2" style="color:#3b5bdb;"></i>Daftar Pasien</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No RM</th>
                  <th>Nama</th>
                  <th>No KTP</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pasiens as $pasien)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td class="font-weight-bold">{{ $pasien->nama }}</td>
                    <td>{{ $pasien->no_ktp }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td style="text-align:right;">
                      <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                      <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pasien ini?')"><i class="fas fa-trash"></i> Hapus</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pasien.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>

@include('layout.footer')
