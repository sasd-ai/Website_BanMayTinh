<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhGia;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhGia;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhGia;

class GoiYSanPhamController extends Controller
{

    public function recommend($productId)
    {
        // Lấy thông tin sản phẩm hiện tại
        $currentProduct = SanPham::find($productId);
        $sanpham = $currentProduct; // Đảm bảo $sanpham có giá trị

        // Collaborative Filtering
        $similarProductsByRating = DanhGia::where('masp', '!=', $productId)
            ->groupBy('masp')
            ->orderByRaw('AVG(sosao) DESC')
            ->limit(4)
            ->pluck('masp');

        // Content-Based Filtering
        $similarProductsByCategory = SanPham::where('MaLoai', $currentProduct->MaLoai)
            ->where('MaSP', '!=', $productId)
            ->limit(4)
            ->pluck('MaSP');

        // Kết hợp kết quả từ cả hai phương pháp
        $recommendedProductIds = $similarProductsByRating->merge($similarProductsByCategory)->unique();

        // Lấy thông tin chi tiết của các sản phẩm được gợi ý
        $recommendedProducts = SanPham::whereIn('MaSP', $recommendedProductIds)->get();

        return view('Home.XemChiTietSP', compact('recommendedProducts', 'sanpham'));
    }
}