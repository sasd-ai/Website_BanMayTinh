<?php

namespace App\Http\Controllers;

use App\Models\LoaiSanPham; // Import model LoaiSanPham
use App\Models\SanPham; // Import model SanPham
use Illuminate\Http\Request; // Import Request để sử dụng request

class SanPhamController extends Controller
{
	
    public function index(Request $request)
    {
        // Lấy kiểu sắp xếp từ request
        $sortType = $request->query('sortType');
        // Khởi tạo query builder để truy vấn database
        $query = SanPham::query();

        // Xử lý sắp xếp sản phẩm dựa trên kiểu sắp xếp
        switch ($sortType) {
            case 'priceIncrease':
                // Sắp xếp sản phẩm theo giá tăng dần
                $query->orderBy('giaban', 'asc');
                break;
            case 'priceDecrease':
                // Sắp xếp sản phẩm theo giá giảm dần
                $query->orderBy('giaban', 'desc');
                break;
        }

        // Lấy danh sách sản phẩm đã được sắp xếp theo phân trang
        $products = $query->paginate(10);

        // Kiểm tra xem request có phải là ajax hay không
        if ($request->ajax()) {
            // Nếu là ajax thì chỉ trả về phần HTML của danh sách sản phẩm
            return view('ChucNang.ProductList_Ajax', compact('products'))->render();
        }

        // Lấy danh sách 4 loại sản phẩm đầu tiên
        $loaiSanPhams = LoaiSanPham::take(4)->get();
        // Trả về view KhamPha với dữ liệu sản phẩm và loại sản phẩm
        return view('ChucNang.KhamPha', compact('products', 'loaiSanPhams'));
    }

  
    public function filterByCategory(Request $request, $TenLoai)
    {
        // Tìm loại sản phẩm dựa trên tên loại
        $loaiSanPham = LoaiSanPham::where('TenLoai', $TenLoai)->firstOrFail();
        // Lấy danh sách sản phẩm thuộc loại đã chọn
        $products = SanPham::where('MaLoai', $loaiSanPham->MaLoai)->paginate(10);

        // Kiểm tra xem request có phải là ajax hay không
        if ($request->ajax()) {
            // Nếu là ajax thì chỉ trả về phần HTML của danh sách sản phẩm
            return view('ChucNang.ProductList_Ajax', compact('products'))->render();
        }

        // Lấy danh sách 4 loại sản phẩm đầu tiên
        $loaiSanPhams = LoaiSanPham::take(4)->get();
        // Trả về view KhamPha với dữ liệu sản phẩm và loại sản phẩm
        return view('ChucNang.KhamPha', compact('products', 'loaiSanPhams'));
    }
	

	public function khamPha(Request $request)
	{
		// Lấy từ khóa tìm kiếm từ request
		$search = $request->query('Search');
		// Kiểm tra xem có từ khóa tìm kiếm hay không
		if ($search) {
			// Nếu có từ khóa tìm kiếm thì lấy danh sách sản phẩm phù hợp
			$products = SanPham::where('TenSP', 'like', '%' . $search . '%')->paginate(10);
		} else {
			// Nếu không có từ khóa tìm kiếm thì lấy danh sách sản phẩm mặc định
			$products = SanPham::paginate(10);
		}

		// Lấy danh sách 4 loại sản phẩm đầu tiên
		$loaiSanPhams = LoaiSanPham::take(4)->get();
		// Trả về view KhamPha với dữ liệu sản phẩm và loại sản phẩm
		return view('ChucNang.KhamPha', compact('products', 'loaiSanPhams'));
	}

	
	public function listRandomProduct(Request $request)
	{
		// Lấy từ khóa tìm kiếm và kiểu sắp xếp từ request
		$search = $request->query('search');
		$softType = $request->query('softType');

		// Lấy danh sách sản phẩm phù hợp với từ khóa tìm kiếm
		$products = SanPham::where('TenSP', 'like', '%' . $search . '%')->paginate(10);
		// Trả về view listRandomProduct với dữ liệu sản phẩm
		return view('sanphams.listRandomProduct', compact('products'));
	}

	
	public function search(Request $request)
	{
		// Lấy từ khóa tìm kiếm từ request
		$search = $request->get('Search');
		// Lấy danh sách sản phẩm phù hợp với từ khóa tìm kiếm
		$products = SanPham::where('TenSP', 'like', '%' . $search . '%')->get();
		// Trả về response json với dữ liệu sản phẩm
		return response()->json($products);
	}

	
	public function autocomplete(Request $request)
    {
        try {
            // Lấy từ khóa tìm kiếm từ request
            $query = $request->query('query');
            // Lấy danh sách 10 sản phẩm phù hợp với từ khóa tìm kiếm
            $sanpham = SanPham::where('TenSP', 'LIKE', '%' . $query . '%')->take(10)->get();
            // Trả về response json với dữ liệu sản phẩm
            return response()->json($sanpham);
        } catch (\Exception $e) {
            // Nếu có lỗi thì trả về response json với thông báo lỗi
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}