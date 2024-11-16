<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GapostController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\JadwalKelasController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BlogController;

// Webhook Verification and Event Handling
Route::get('/facebook/webhook', [BlogController::class, 'verifyWebhook']);
Route::post('/facebook/webhook', [BlogController::class, 'handleWebhook']);

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index'); // Blog listing
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create'); // Blog create form
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store'); // Store blog post



// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat', [ChatController::class, 'store']);

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panduan Akademik
    Route::get('/panduan-akademik', function () {
        return view('panduan-akademik');
    })->name('panduan-akademik');

    // Galeri Akademik (Accessible to all authenticated users)
    Route::get('/galeri-akademik', [GapostController::class, 'index'])->name('galeri-akademik');

    // Jadwal Kelas
    Route::get('/jadwal-kelas', [JadwalKelasController::class, 'index'])->name('jadwal-kelas.index');
    Route::get('/jadwal-kelas/{hari}', [JadwalKelasController::class, 'showByDay'])
        ->name('jadwal-kelas.showByDay')
        ->where('hari', 'Senin|Selasa|Rabu|Kamis|Jumat');

    // Jadwal Kegiatan
    Route::get('/jadwal-kegiatan', [JadwalKegiatanController::class, 'index'])->name('jadwal-kegiatan.index');

    // Admin Routes
    Route::middleware(['admin'])->group(function () {

        // Galeri Akademik Admin Routes
        Route::get('/galeri-akademik/create', [GapostController::class, 'create'])->name('gaposts.create');  // Static route first
        Route::post('/galeri-akademik', [GapostController::class, 'store'])->name('gaposts.store');
        Route::delete('/galeri-akademik/{gapost}', [GapostController::class, 'destroy'])->name('gaposts.destroy');
        Route::get('/galeri-akademik/{gapost}', [GapostController::class, 'show'])->name('gaposts.show');  // Dynamic route after
        Route::get('/galeri-akademik/{gapost}/edit', [GapostController::class, 'edit'])->name('gaposts.edit');
        Route::put('/galeri-akademik/{gapost}', [GapostController::class, 'update'])->name('gaposts.update');

        // Jadwal Kelas Admin Routes
        Route::get('/jadwal-kelas/create', [JadwalKelasController::class, 'create'])->name('jadwal-kelas.create');
        Route::post('/jadwal-kelas', [JadwalKelasController::class, 'store'])->name('jadwal-kelas.store');
        Route::get('/jadwal-kelas/{id}/edit', [JadwalKelasController::class, 'edit'])->name('jadwal-kelas.edit');
        Route::put('/jadwal-kelas/{id}', [JadwalKelasController::class, 'update'])->name('jadwal-kelas.update');
        Route::delete('/jadwal-kelas/{id}', [JadwalKelasController::class, 'destroy'])->name('jadwal-kelas.destroy');

        // Jadwal Kegiatan Admin Routes
        Route::get('/jadwal-kegiatan/create', [JadwalKegiatanController::class, 'create'])->name('jadwal-kegiatan.create');  // Static route first
        Route::post('/jadwal-kegiatan', [JadwalKegiatanController::class, 'store'])->name('jadwal-kegiatan.store');
        Route::delete('/jadwal-kegiatan/{jadwalKegiatan}', [JadwalKegiatanController::class, 'destroy'])->name('jadwal-kegiatan.destroy');
        Route::get('/jadwal-kegiatan/{jadwalKegiatan}', [JadwalKegiatanController::class, 'show'])->name('jadwal-kegiatan.show');  // Dynamic route after
        Route::get('/jadwal-kegiatan/{jadwalKegiatan}/edit', [JadwalKegiatanController::class, 'edit'])->name('jadwal-kegiatan.edit');
        Route::put('/jadwal-kegiatan/{jadwalKegiatan}', [JadwalKegiatanController::class, 'update'])->name('jadwal-kegiatan.update');
    });

    // Discussions with nested Comments
    Route::resource('discussions', DiscussionController::class);
    Route::post('/discussions/{discussion}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/discussions/{discussion}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/discussions/{discussion}', [DiscussionController::class, 'show'])->name('discussions.show');

});

// Authentication Routes
require __DIR__.'/auth.php';
