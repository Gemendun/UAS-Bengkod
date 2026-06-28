
{{-- resources/views/admin/poli.blade.php --}}
@include('layout.header', ['title' => 'Kelola Poli'])
@include('layout.sidebar_admin')

  <div class="content-header">
    <h1 class="poli-page-title">Kelola Poli</h1>
  </div>

  <section class="content">

    {{-- Notifikasi --}}
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

    <div class="row">
      <!-- Form Tambah/Edit Poli -->
      <div class="col-md-4">
        <div class="card {{ isset($editMode) ? 'card-warning' : 'card-primary' }}">
          <div class="card-header">
            <h3 class="card-title">{{ isset($editMode) ? 'Edit Poli' : 'Tambah Poli' }}</h3>
          </div>
          <form action="{{ isset($editMode) ? route('admin.poli.update', $poli->id) : route('admin.poli.store') }}" method="POST">
            @csrf
            @if(isset($editMode))
              @method('PUT')
            @endif
            <div class="card-body">
              <div class="form-group">
                <label>Nama Poli</label>
                <input type="text" name="nama" class="form-control" required
                  value="{{ old('nama', isset($editMode) ? $poli->nama : '') }}">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', isset($editMode) ? $poli->keterangan : '') }}</textarea>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn {{ isset($editMode) ? 'btn-warning' : 'btn-primary' }} btn-block">
                {{ isset($editMode) ? 'Update' : 'Simpan' }}
              </button>
              @if(isset($editMode))
                <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary btn-block mt-2">Batal Edit</a>
              @endif
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Daftar Poli -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-hospital-alt mr-2" style="color:#3b5bdb;"></i>Daftar Poli</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Poli</th>
                  <th>Keterangan</th>
                  <th style="text-align:right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($polis as $poli)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="font-weight-bold">{{ $poli->nama }}</td>
                    <td>{{ $poli->keterangan ?? '-' }}</td>
                    <td style="text-align:right;">
                      <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                      <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus poli ini?')"><i class="fas fa-trash"></i> Hapus</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center text-muted py-4">Belum ada data poli.</td>
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
