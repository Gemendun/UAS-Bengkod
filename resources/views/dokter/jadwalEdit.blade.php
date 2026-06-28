@include('layout.header', ['title' => 'Edit Jadwal Periksa'])
@include('layout.sidebar_dokter')

  <div class="content-header">
    <h1 class="poli-page-title">Edit Jadwal Periksa</h1>
  </div>

  <section class="content">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-calendar-edit mr-2" style="color:#3b5bdb;"></i>Form Edit Jadwal</h3>
          </div>
          <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label>Hari</label>
                <select name="hari" class="form-control" required>
                  @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required value="{{ $jadwal->jam_mulai }}">
              </div>
              <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required value="{{ $jadwal->jam_selesai }}">
              </div>
              <div class="form-group">
                <label>Status Jadwal</label>
                <select name="status" class="form-control" required>
                  <option value="1" {{ $jadwal->status == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ $jadwal->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                <small class="form-text text-muted">Hanya satu jadwal yang boleh aktif.</small>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-save mr-1"></i>Update</button>
              <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-block mt-2">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>

@include('layout.footer')