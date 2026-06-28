@include('layout.header', ['title' => 'Profil Saya'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Profil Saya</h1>
  </div>

  <section class="content">
    @if (session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger mb-3"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Profil Dokter</h3>
          </div>
          <form action="{{ route('dokter.profile.update') }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label style="font-size:12px; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $dokter->nama) }}" required>
              </div>
              <div class="form-group">
                <label style="font-size:12px; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $dokter->user->alamat) }}" required>
              </div>
              <div class="form-group">
                <label style="font-size:12px; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Password Baru <span style="font-weight:400; text-transform:none; letter-spacing:0; color:#94a3b8;">(opsional)</span></label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
              </div>
              <div class="form-group mb-0">
                <label style="font-size:12px; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:0.05em;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@include('layout.footer')