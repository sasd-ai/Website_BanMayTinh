<?php

use App\Http\Controllers\ChatBoxController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\GoiYSanPhamController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\ThanhToanMOMO;
use App\Http\Controllers\UserInformationCotroller;
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
    return view('welcome');
})->name('welcome');
Route::get('/', ['App\Http\Controllers\HomeController', 'getHomeData'])->name('welcome');
//xem chi tiết sản phẩm
Route::get('/XemChiTietSP', function () {
    return view('XemChiTietSP');
})->name('xemchitietsp');
Route::get('xemchitietsanpham/{masp}', [HomeController::class, 'getSanPhamById'])->name('XemChiTietSanPham');

//đăng nhập
Route::get('/DangNhap', function () {
    return view('Account/DangNhap');
})->name('DangNhap');
Route::post('/DangNhap', [App\Http\Controllers\AccountController::class, 'checkLogin'])->name('checkLogin');
//đăng ký
Route::get('/DangKy', function () {
    return view('Account/DangKy');
})->name('DangKy');

Route::post('/DangKy', [App\Http\Controllers\AccountController::class, 'store'])->name('storeAccount');

//đăng xuất
Route::get('/logout', 'App\Http\Controllers\AccountController@logout')->name('logout');
//thông tin user
Route::get('/UserInformation', [UserInformationCotroller::class, 'getUserInformation'])->name('UserInformation')->middleware('auth');


//Login Googel
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('logingoogle');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//Cập nhật Khách hàng
Route::post('/update-information', [UserInformationCotroller::class, 'updateInformation'])->name('user.updateInformation');

//Gio Hàng
//Route::get('/GioHang', [GioHangController::class, 'showCart'])->name('giohang');
Route::get('/GioHang', function () {
    return view('GioHang/GioHang');
})->name('giohang');
Route::get('/Cart', function () {
    return view('GioHang/Cart');
})->name('Cart');
Route::post('/XemChiTietSP',[App\Http\Controllers\GioHangController::class,'addToCart'])->name('giohang.addToCart');

Route::patch('/cart/item/{MaGH}/{MaSP}', 'App\Http\Controllers\GioHangController@updateItem')->name('cart.update');
Route::delete('/cart/item/{MaGH}/{MaSP}', 'App\Http\Controllers\GioHangController@deleteItem')->name('cart.delete');

//MuaNgay
Route::post('/thanh-toan', 'App\Http\Controllers\ThanhToanController@thanhToan')->name('ThanhToan');
//ThanhToan
Route::post('/pay-ment', [ThanhToanController::class, 'payment'])->name('payment.process');
//khuyến mãi
// Route cho tính năng xem khuyến mãi
Route::get('/khuyen-mai', [KhuyenMaiController::class, 'getKhuyenMai'])->name('khuyenmai');

//Thanh toán tích hợp
Route::post('/payment/store', 'PaymentController@storeonline');

//Sản Phẩm
Route::get('/KhamPha', [SanPhamController::class, 'khamPha'])->name('KhamPha');
Route::get('/products', [SanPhamController::class, 'index'])->name('products.index');
// web.php hoặc routes/web.php
// The filter route seems correct, it should accept query parameters.
Route::get('/products/category/{TenLoai}', [SanPhamController::class, 'filterByCategory'])->name('products.filterByCategory');
//search
Route::get('/Search', 'SanPhamController@search')->name('Search');
Route::get('/autocomplete', [SanPhamController::class, 'autocomplete'])->name('autocomplete');

//HoiDap
Route::get('/HoiDap', function () {
    return view('ChucNang/HoiDap');
})->name('HoiDap');
//LienHe
Route::get('/LienHe', function () {
    return view('ChucNang/LienHe');
})->name('LienHe');

//chatbox
Route::get('/Chatbox', function () {
    return view('ChucNang/Chatbox');
})->name('Chatbox');

//đánh giá 
Route::post('/submit-danhgia', [DanhGiaController::class, 'store'])->name('submit.danhgia');

//Hủy đơn hàng 
Route::post('/huy-donhang', [ThanhToanController::class, 'HuyDonHang'])->name('huyDonHang');

// Route để xử lý trả về thành công từ MOMO
Route::get('/payment-success', [ThanhToanMOMO::class, 'paymentSuccess'])->name('payment.success');

// Route để xử lý thông báo từ MOMO
Route::post('/payment-notify', [ThanhToanMOMO::class, 'paymentNotify'])->name('payment.notify');

// Route thanh toán MOMO
Route::post('/momo', [ThanhToanMOMO::class, 'momo_payment'])->name('thanhtoanmomo');

//Route Gợi ý sản phẩm

//Route ChatBox
Route::post('/chatbox', [ChatBoxController::class, 'ChatBox'])->name('chatbox');
// routes/web.php
Route::post('/send', [ChatBoxController::class, 'sendMessage'])->name('send');



