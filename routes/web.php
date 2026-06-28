<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminObatController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\JadwalController;
// Halaman utama
Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Dokter
    Route::get('/dokter', [AdminController::class, 'dokterIndex'])->name('admin.dokter.index');
    Route::post('/dokter', [AdminController::class, 'dokterStore'])->name('admin.dokter.store');
    Route::get('/dokter/{id}/edit', [AdminController::class, 'dokterEdit'])->name('admin.dokter.edit');
    Route::put('/dokter/{id}', [AdminController::class, 'dokterUpdate'])->name('admin.dokter.update');
    Route::delete('/dokter/{id}', [AdminController::class, 'dokterDestroy'])->name('admin.dokter.destroy');

    // Pasien
    Route::get('/pasien', [AdminController::class, 'pasienIndex'])->name('admin.pasien.index');
    Route::post('/pasien', [AdminController::class, 'pasienStore'])->name('admin.pasien.store');
    Route::get('/pasien/{id}/edit', [AdminController::class, 'pasienEdit'])->name('admin.pasien.edit');
    Route::put('/pasien/{id}', [AdminController::class, 'pasienUpdate'])->name('admin.pasien.update');
    Route::delete('/pasien/{id}', [AdminController::class, 'pasienDestroy'])->name('admin.pasien.destroy');

    // Poli
    Route::get('/poli', [\App\Http\Controllers\AdminPoliController::class, 'index'])->name('admin.poli.index');
    Route::post('/poli', [\App\Http\Controllers\AdminPoliController::class, 'store'])->name('admin.poli.store');
    Route::get('/poli/{id}/edit', [\App\Http\Controllers\AdminPoliController::class, 'edit'])->name('admin.poli.edit');
    Route::put('/poli/{id}', [\App\Http\Controllers\AdminPoliController::class, 'update'])->name('admin.poli.update');
    Route::delete('/poli/{id}', [\App\Http\Controllers\AdminPoliController::class, 'destroy'])->name('admin.poli.destroy');

    //obat
    // Obat
    Route::get('/obat', [AdminObatController::class, 'index'])->name('admin.obat.index');
    Route::post('/obat', [AdminObatController::class, 'store'])->name('admin.obat.store');
    Route::get('/obat/{id}/edit', [AdminObatController::class, 'edit'])->name('admin.obat.edit');
    Route::put('/obat/{id}', [AdminObatController::class, 'update'])->name('admin.obat.update');
    Route::delete('/obat/{id}', [AdminObatController::class, 'destroy'])->name('admin.obat.destroy');
    // Manajemen Stok
    Route::post('/obat/{id}/tambah-stok', [AdminObatController::class, 'tambahStok'])->name('admin.obat.tambahStok');
    Route::post('/obat/{id}/kurangi-stok', [AdminObatController::class, 'kurangiStok'])->name('admin.obat.kurangiStok');
});


// Routes untuk Authentication: Login, Register, Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Routes untuk Role: Pasien
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/pasien', [PasienController::class, 'index'])->name('dashboardPasien');
    Route::get('/pasien/periksa', [PasienController::class, 'showPeriksa'])->name('periksaPasien');
    Route::post('/pasien/periksa', [PasienController::class, 'storePeriksa'])->name('storePeriksa');
    Route::get('/periksa/{id}/detail', [PasienController::class, 'showDetail'])->name('periksa.detail');
});


// Routes untuk Role: Dokter
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dashboardDokter');
    Route::get('/dokter/periksa', [DokterController::class, 'showPeriksa'])->name('periksaDokter');
    Route::put('/dokter/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('updatePeriksa');

    Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('obatDokter');
    Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('storeObat');
    Route::put('/dokter/obat/{id}', [DokterController::class, 'updateObat'])->name('updateObat');
    Route::delete('/dokter/obat/{id}', [DokterController::class, 'deleteObat'])->name('deleteObat');

    // ✅ Jadwal Periksa
    Route::get('/jadwal-periksa', [App\Http\Controllers\JadwalPeriksaController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal-periksa/create', [App\Http\Controllers\JadwalPeriksaController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal-periksa', [App\Http\Controllers\JadwalPeriksaController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal-periksa/{id}/edit', [App\Http\Controllers\JadwalPeriksaController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal-periksa/{id}', [App\Http\Controllers\JadwalPeriksaController::class, 'update'])->name('jadwal.update');
    Route::post('/jadwal/{id}/aktifkan', [App\Http\Controllers\JadwalPeriksaController::class, 'aktifkan'])->name('jadwal.aktifkan');
    // Untuk profil dokter
    Route::get('/dokter/profile', [DokterController::class, 'editProfile'])->name('dokter.profile.edit');
    Route::put('/dokter/profile', [DokterController::class, 'updateProfile'])->name('dokter.profile.update');


    Route::get('/dokter/periksa', [DokterController::class, 'showPeriksa'])->name('periksaDokter');
    Route::get('/dokter/periksa/{id}/edit', [DokterController::class, 'editPeriksa'])->name('periksa.edit');
    Route::put('/dokter/periksa/{id}', [DokterController::class, 'updatePeriksa'])->name('updatePeriksa');

    // Tambahkan di dalam group yang sesuai (misalnya dengan middleware 'auth' dan role 'dokter')
    Route::get('/dokter/riwayat', [DokterController::class, 'riwayatPasien'])->name('riwayatDokter');

    Route::get('/dokter/riwayat/{id}', [DokterController::class, 'riwayatPasienDetail'])->name('dokter.riwayat.detail');
});
