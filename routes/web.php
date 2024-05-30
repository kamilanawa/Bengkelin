<?php

use App\Http\Controllers\AdminController;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, BengkelController, BookingController, LayananController, JadwalController, ProfileUserController, ServiceController, TransaksiController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('user.landingpage');
});
// Route::get('/aboutpage', function () {
//     return view('aboutus');
// });

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/userregister', [AuthController::class, "userregister"])->name('userregister');
Route::get('/ownerregister', [AuthController::class, "ownerregister"])->name('ownerregister');
Route::post('/userregister', [AuthController::class, "douserregister"])->name('do.userregister');
Route::post('/ownerregister', [AuthController::class, "doownerregister"])->name('do.ownerregister');

//forgot password
Route::get('/forgot-password', [AuthController::class, 'forgotPassView'])->name('forgotPassView');
Route::post('/forgot-password-send', [AuthController::class, 'forgotPassSend'])->name('forgotPassSend');

//reset password
Route::get('/reset/{tokenURL}/password', [AuthController::class, 'resetPasswordView'])->name('resetTokenView');
Route::post('/reset/password/send', [AuthController::class, 'resetPasswordSend'])->name('resetTokenSend');

// USER
Route::middleware(['auth:web'])->group(function () {
    Route::get('/profileuser', [ProfileUserController::class, 'showuser']);
    Route::get('/profileuser/{id}', [ProfileUserController::class, 'showdetailuser']);
    Route::get('/profileuser/{id}/edit', [ProfileUserController::class, 'edit']);
    Route::post('/profileuser/{id}', [ProfileUserController::class, 'storedetailuser']);
    Route::put('/profileuser/{id}', [ProfileUserController::class, 'updatedetailuser']);
    Route::get('/profilekendaraan', [ProfileUserController::class, 'showkendaraan']);
    Route::get('/profiletransaksi', [ProfileUserController::class, 'showtransaksi']);
    Route::get('/profilekendaraan/add', [ProfileUserController::class, 'createkendaraan']);
    Route::post('/profilekendaraan', [ProfileUserController::class, 'storekendaraan']);
    Route::get('/profilekendaraan/{id}/delete', [ProfileUserController::class, 'destroykendaraan']);
    Route::get('/profilekendaraan/{id}/edit', [ProfileUserController::class, 'editkendaraan']);
    Route::put('/profilekendaraan/{id}', [ProfileUserController::class, 'updatekendaraan']);
    Route::get('/servicepage', [ServiceController::class, 'index']);
    Route::get('/detailbengkelpage/{id}', [ServiceController::class, 'detailBengkel']);
    Route::get('/booking/add/{id}', [ServiceController::class, 'bookingPage']);
    Route::post('/booking', [BookingController::class, 'booking']);
    // Menambahkan route baru untuk memberikan rating kepada hasil booking
    Route::patch('/booking/{id}/rating', [BookingController::class, 'rating'])->name('booking.rating');
});

// ADMIN
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/adminindex', [AdminController::class, 'index'])->name('adminindex');
    Route::get('/adminlistuser', [AdminController::class, 'listuser'])->name('showlistuser');
    Route::get('/adminlistbengkel', [AdminController::class, 'listbengkel'])->name('showlistbengkel');
    Route::get('/adminlistowner', [AdminController::class, 'listowner'])->name('showlistowner');
    Route::get('/detailuser/{id}', [AdminController::class, 'detailuser'])->name('detailuser');
    Route::get('/detailowner/{id}', [AdminController::class, 'detailowner'])->name('detailowner');
    Route::get('/detailbengkel/{id}', [AdminController::class, 'detailbengkel'])->name('detailbengkel');
    Route::get('/adminlistowner/{id}/delete', [AdminController::class, 'destroyowner'])->name('deletelistowner');
    Route::get('/adminlistuser/{id}/delete', [AdminController::class, 'destroyuser'])->name('deletelistuser');
    Route::get('/adminlistbengkel/{id}/delete', [AdminController::class, 'destroybengkel'])->name('deletelistbengkel');
});

// BENGKEL
Route::prefix('/owner')->middleware('auth:pemilikbengkel')->group(function () {
    Route::get('/', [BengkelController::class, 'index'])->name('bengkel.index');
    Route::resource('bengkel', BengkelController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('jadwal', JadwalController::class);
});

Route::prefix('/owner')->middleware(['auth:pemilikbengkel'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('bengkeltransaksi');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edittransaksi']);
    // Menambahkan route baru untuk menampilkan form tambah gambar
    Route::get('/transaksi/{id}/edit/gambar', [TransaksiController::class, 'tambahgambar']);
    // Menambahkan route baru untuk menyimpan gambar
    Route::post('/transaksi/{id}/edit/gambar', [TransaksiController::class, 'simpantambahgambar'])->name('simpantambahgambar');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'detailtransaksi']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'updatetransaksi'])->name('updatetransaksi');
});
