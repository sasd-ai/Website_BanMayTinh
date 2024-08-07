<?php

namespace App\Providers;

use App\Models\GioHang;
use App\Models\KhuyenMai;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\LoaiSanPham;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['GioHang.GioHang','GioHang.Cart'], function ($view) {
            if (auth()->check()) {
                $maKH = auth()->user()->khachhang->MaKH;
                $gioHang = GioHang::where('MaKH', $maKH)->first();
            
                if ($gioHang) {
                    $cartItems = $gioHang->chiTietGioHang()->with('sanPham')->get();
                    $grandTotal = $gioHang->TongTien; // Lấy ra giá trị 'TongTien' từ giỏ hàng
                } else {
                    $cartItems = collect([]);
                    $grandTotal = 0;
                }
            
                $view->with(compact('cartItems', 'grandTotal')); // Chia sẻ ra view
            } 
        });

        view::composer('*', function ($view) {
            $view->with('loaiSanPhams', LoaiSanPham::take(4)->get());
        });
    }
   
}
