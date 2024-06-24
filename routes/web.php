    <?php

    use App\Http\Controllers\AbsenController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\KaryawanController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\JabatanController;
    use App\Http\Controllers\AboutController;

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    // Karyawan
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/datakaryawan', [KaryawanController::class, 'index'])->name('datakaryawan.index');
    Route::get('/datakaryawan/tambah', [KaryawanController::class, 'tambah'])->name('datakaryawan.tambah');
    Route::post('/datakaryawan', [KaryawanController::class, 'store'])->name('datakaryawan.store');
    Route::get('/datakaryawan/edit/{id}', [KaryawanController::class, 'edit'])->name('datakaryawan.edit');
    Route::put('/datakaryawan/update/{id}', [KaryawanController::class, 'update'])->name('datakaryawan.update');
    Route::delete('/datakaryawan/hapus/{id}', [KaryawanController::class, 'hapus'])->name('datakaryawan.hapus');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/hapus/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::resource('/users', UserController::class)->except(['show']);
    // Jabatan
    Route::get('/jabatans', [JabatanController::class, 'index'])->name('jabatans.index');
    Route::get('/jabatans/create', [JabatanController::class, 'create'])->name('jabatans.create');
    Route::get('/jabatans', [JabatanController::class, 'store'])->name('users.store');
    Route::get('/jabatans/edit/{id}', [JabatanController::class, 'edit'])->name('jabatans.edit');
    Route::put('/jabatans/update/{id}', [JabatanController::class, 'update'])->name('jabatans.update');
    Route::delete('/jabatans/destroy/{id}', [JabatanController::class, 'destroy'])->name('jabatans.destroy');
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    Route::resource('/jabatans', JabatanController::class)->except(['show']);
    // Absen
    Route::resource('/absen', AbsenController::class)->except(['create', 'store']); // Menggunakan Route::resource untuk CRUD
    Route::get('/absen/tambah', [AbsenController::class, 'create'])->name('absen.create'); // Rute tambahan untuk menampilkan form tambah
    Route::post('/absen/store', [AbsenController::class, 'store'])->name('absen.store'); // Rute tambahan untuk menyimpan data
    Route::post('/absen/masuk', [AbsenController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen/keluar', [AbsenController::class, 'absenKeluar'])->name('absen.keluar');

    // Tambahan untuk Edit dan Update Absen
    Route::get('/absen/edit/{id}', [AbsenController::class, 'edit'])->name('absen.edit');
    Route::put('/absen/{id}', [AbsenController::class, 'update'])->name('absen.update');
    Route::delete('/absen/{id}', [AbsenController::class, 'destroy'])->name('absen.destroy');
