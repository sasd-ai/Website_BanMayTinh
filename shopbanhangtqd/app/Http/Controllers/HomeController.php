<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use DB;
use Phpml\Clustering\KMeans;
class HomeController extends Controller
{
    public function getHomeData()
    {
        $sanPham = $this->getSanPhamCPU();
        $sanPham1 = $this->getSanPhamGPU();
        $sanPham2 = $this->getSanPhamKEYBOARD();
        $sanPham3 = $this->getSanPhamMONITOR();
        $loaisp = $this->getTenLoai();
        
       
        return view('welcome', [
            'sanPham' => $sanPham,
            'sanPham1' => $sanPham1,
            'sanPham2' => $sanPham2,
            'sanPham3' => $sanPham3,
            'loaisp' => $loaisp,
            
           
        ]);
    }
    public function getSanPhamCPU()
    {
        return Sanpham::where('maloai', 'CPU')->get();
    }
    public function getSanPhamGPU()
    {
        return Sanpham::where('maloai', 'GPU')->get();
    }
    public function getSanPhamKEYBOARD()
    {
        return Sanpham::where('maloai', 'Keyboard')->get();
    }
    public function getSanPhamMONITOR()
    {
        return Sanpham::where('maloai', 'Monitor')->get();
    }

    public function getTenLoai()
    {
        return LoaiSanPham::all();
    } 
    // public function getSanPhamById($masp) 
    // {
    //     $danhgia = DanhGia::where('masp', $masp)->get();
    //     $sosao_trungbinh = DanhGia::where('masp', $masp)->average('sosao');
    //     $sanpham = SanPham::find($masp);
    //     $loaisp = $this->GetTenLoai(); // Giả sử GetTenLoai() là hàm lấy thông tin loại sản phẩm

    //     // Collaborative Filtering: Tìm các sản phẩm được đánh giá cao bởi người dùng
    //     $similarProductsByRating = DanhGia::where('masp', '!=', $masp)
    //         ->groupBy('masp')
    //         ->orderByRaw('AVG(sosao) DESC')
    //         ->limit(4)
    //         ->pluck('masp');

    //     // Content-Based Filtering: Tìm các sản phẩm cùng loại
    //     $similarProductsByCategory = SanPham::where('MaLoai', $sanpham->MaLoai)
    //         ->where('MaSP', '!=', $masp)
    //         ->limit(4)
    //         ->pluck('MaSP');

    //     // Kết hợp kết quả từ cả hai phương pháp
    //     $recommendedProductIds = $similarProductsByRating->merge($similarProductsByCategory)->unique();

    //     // Lấy thông tin chi tiết của các sản phẩm được gợi ý
    //     $recommendedProducts = SanPham::whereIn('MaSP', $recommendedProductIds)->get();

    //     // Truyền dữ liệu vào view
    //     return view('Home.XemChiTietSP', compact('sanpham', 'masp', 'loaisp','danhgia','sosao_trungbinh', 'recommendedProducts'));
    // }
    public function getSanPhamById($masp) 
{
    // Lấy thông tin đánh giá sản phẩm
    $danhgia = DanhGia::where('masp', $masp)->get();
    $sosao_trungbinh = DanhGia::where('masp', $masp)->average('sosao');
    
    // Lấy thông tin sản phẩm
    $sanpham = SanPham::find($masp);
    
    // Lấy thông tin loại sản phẩm
    $loaisp = $this->GetTenLoai(); 

    // Lấy tất cả sản phẩm và tạo bộ đặc trưng
    $allProducts = SanPham::all();
    $dactrung = [];
    $mapSanPham = []; 
    foreach ($allProducts as $product) {
        $dactrung[] = [
            (float)$product->GiaBan, // Giá sản phẩm
            (float)$product->sosao_trungbinh, // Đánh giá trung bình
            (int)$product->MaLoai, // Chuyển đổi MaLoai thành số nguyên
            // Thêm các đặc trưng khác nếu có
        ];
        $mapSanPham[] = $product->MaSP; // Map giữa đặc trưng và ID sản phẩm
    }

    // Tạo và huấn luyện mô hình phân cụm K-Means
    $kmeans = new KMeans(10); // Giả sử ta muốn phân thành 10 cụm
    $cacCum = $kmeans->cluster($dactrung); 

    // Tìm cụm của sản phẩm hiện tại
    $dactrungSanPhamHienTai = [
        (float)$sanpham->GiaBan,
        (float)$sosao_trungbinh,
        (int)$sanpham->MaLoai,
        // Các đặc trưng khác nếu có
    ];
    $cumHienTai = -1; 
    foreach ($cacCum as $indexCum => $cum) {
        foreach ($cum as $index => $dactrungSanPham) {
            if ($dactrungSanPham == $dactrungSanPhamHienTai) {
                $cumHienTai = $indexCum;
                break 2;
            }
        }
    }

    // Gợi ý các sản phẩm trong cùng cụm
    $idSanPhamGoiY = []; 
    if ($cumHienTai != -1) {
        foreach ($cacCum[$cumHienTai] as $index => $dactrungSanPham) {
            $idSanPham = $mapSanPham[$index];
            if ($idSanPham != $masp) {
                $idSanPhamGoiY[] = $idSanPham;
            }
        }
    }

    // Lấy thông tin chi tiết của các sản phẩm được gợi ý và giới hạn số lượng
    $sanPhamGoiY = SanPham::whereIn('MaSP', $idSanPhamGoiY)->take(4)->get(); // Giới hạn 4 sản phẩm

    // Truyền dữ liệu vào view
    return view('Home.XemChiTietSP', compact('sanpham', 'masp', 'loaisp','danhgia','sosao_trungbinh', 'sanPhamGoiY'));
}
    
}
