<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatusSiswaController;
use App\Http\Controllers\ListPrestasiSiswaController;
use App\Models\Blog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::prefix('main')->group(function(){
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/blog', [HomeController::class, 'blogs'])->name('blog');
    Route::get('/blog/{slug}', [HomeController::class, 'show'])->name('blog.page');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('siswa')->group(function(){
        Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/create', [SiswaController::class, 'create'])->name('siswa.create');
        Route::post('/post',[SiswaController::class,'post'])->name('siswa.post');
        Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::post('/update/{id}',[SiswaController::class,'update'])->name('siswa.update');
        Route::delete('/delete/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
    });

    Route::prefix('blog')->group(function(){
        Route::get('/',[BlogController::class, 'index'])->name('blog.index');
        Route::get('/create',[BlogController::class, 'create'])->name('blog.create');
        Route::post('/post',[BlogController::class, 'post'])->name('blog.post');
        Route::get('/edit/{id}',[BlogController::class, 'edit'])->name('blog.edit');
        Route::post('/update/{id}',[BlogController::class, 'update'])->name('blog.update');
        Route::delete('/delete/{id}',[BlogController::class, 'delete'])->name('blog.delete');
    });

    Route::prefix('status-siswa')->group(function(){
        Route::get('/', [StatusSiswaController::class, 'index'])->name('statussiswa.index');
        Route::get('/create', [StatusSiswaController::class, 'create'])->name('statussiswa.create');
        Route::post('/post',[StatusSiswaController::class,'post'])->name('statussiswa.post');
        // Route::get('/edit/{id}', [StatusSiswaController::class, 'edit'])->name('statussiswa.edit');
        // Route::post('/update/{id}',[StatusSiswaController::class,'update'])->name('statussiswa.update');
        // Route::delete('/delete/{id}', [StatusSiswaController::class, 'delete'])->name('statussiswa.delete');
    });

    Route::prefix('list-prestasi-siswa')->group(function(){
        Route::get('/{id}', [ListPrestasiSiswaController::class, 'index'])->name('listprestasisiswa.index');
        Route::get('/{id}/create', [ListPrestasiSiswaController::class, 'create'])->name('listprestasisiswa.create');
        Route::post('/post/{id}',[ListPrestasiSiswaController::class,'post'])->name('listprestasisiswa.post');
        Route::get('/edit/{id}', [ListPrestasiSiswaController::class, 'edit'])->name('listprestasisiswa.edit');
        Route::post('/update/{id}',[ListPrestasiSiswaController::class,'update'])->name('listprestasisiswa.update');
        // Route::delete('/delete/{id}', [StatusSiswaController::class, 'delete'])->name('statussiswa.delete');
    });
});

require __DIR__.'/auth.php';
