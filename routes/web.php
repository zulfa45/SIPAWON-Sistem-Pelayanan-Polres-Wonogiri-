<?php

use App\Models\Berita;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $berita = Berita::with('kategori')->where('status', 'published')->latest()->take(3)->get();
    return view('welcome', compact('berita'));
})->name('home');

Route::get('/berita/{slug}', function ($slug) {
    $berita = Berita::with(['kategori', 'user'])->where('slug', $slug)->where('status', 'published')->firstOrFail();
    
    // You can also fetch latest news for a sidebar widget
    $latest_news = Berita::where('status', 'published')->where('id', '!=', $berita->id)->latest()->take(5)->get();
    
    return view('berita.show', compact('berita', 'latest_news'));
})->name('berita.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            $totalPengaduan = \App\Models\Pengaduan::count();
            $totalSim = \App\Models\RegistrasiSim::count();
            $totalStnk = \App\Models\RegistrasiStnk::count();
            $totalSkck = \App\Models\RegistrasiSkck::count();
            return view('admin.dashboard', compact('totalPengaduan', 'totalSim', 'totalStnk', 'totalSkck'));
        })->name('dashboard');
        
        Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);
        
        Route::get('/sim', [\App\Http\Controllers\Admin\LayananAdminController::class, 'indexSim'])->name('sim.index');
        Route::patch('/sim/{id}', [\App\Http\Controllers\Admin\LayananAdminController::class, 'updateSim'])->name('sim.update');
        Route::get('/stnk', [\App\Http\Controllers\Admin\LayananAdminController::class, 'indexStnk'])->name('stnk.index');
        Route::patch('/stnk/{id}', [\App\Http\Controllers\Admin\LayananAdminController::class, 'updateStnk'])->name('stnk.update');
        Route::get('/skck', [\App\Http\Controllers\Admin\LayananAdminController::class, 'indexSkck'])->name('skck.index');
        Route::patch('/skck/{id}', [\App\Http\Controllers\Admin\LayananAdminController::class, 'updateSkck'])->name('skck.update');
        Route::get('/skck/{id}/export-pdf', [\App\Http\Controllers\Admin\LayananAdminController::class, 'exportPdfSkck'])->name('skck.export_pdf');
        Route::get('/pengaduan', [\App\Http\Controllers\Admin\LayananAdminController::class, 'indexPengaduan'])->name('pengaduan.index');
        Route::get('/pengaduan/export-pdf', [\App\Http\Controllers\Admin\LayananAdminController::class, 'exportPdfPengaduan'])->name('pengaduan.export_pdf');
        Route::patch('/pengaduan/{id}', [\App\Http\Controllers\Admin\LayananAdminController::class, 'updatePengaduan'])->name('pengaduan.update');
        
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    });

    // User Routes
    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', function () {
            return redirect()->route('home');
        })->name('dashboard');

        Route::get('/layanan/sim', [\App\Http\Controllers\User\LayananController::class, 'sim'])->name('layanan.sim');
        Route::post('/layanan/sim', [\App\Http\Controllers\User\LayananController::class, 'storeSim'])->name('layanan.sim.store');
        
        Route::get('/layanan/stnk', [\App\Http\Controllers\User\LayananController::class, 'stnk'])->name('layanan.stnk');
        Route::post('/layanan/stnk', [\App\Http\Controllers\User\LayananController::class, 'storeStnk'])->name('layanan.stnk.store');
        
        Route::get('/layanan/skck', [\App\Http\Controllers\User\LayananController::class, 'skck'])->name('layanan.skck');
        Route::post('/layanan/skck', [\App\Http\Controllers\User\LayananController::class, 'storeSkck'])->name('layanan.skck.store');
        Route::get('/layanan/skck/{id}/export-pdf', [\App\Http\Controllers\User\LayananController::class, 'exportPdfSkck'])->name('layanan.skck.export_pdf');
        
        Route::get('/layanan/pengaduan', [\App\Http\Controllers\User\LayananController::class, 'pengaduan'])->name('layanan.pengaduan');
        Route::post('/layanan/pengaduan', [\App\Http\Controllers\User\LayananController::class, 'storePengaduan'])->name('layanan.pengaduan.store');
        
        Route::get('/riwayat', [\App\Http\Controllers\User\LayananController::class, 'riwayat'])->name('riwayat');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
