<?php

namespace App\Http\Controllers;

use App\Models\SanPham; // Import model SanPham để truy cập vào bảng SanPham trong database
use App\Models\GioHang; // Import model GioHang để truy cập vào bảng GioHang trong database
use App\Models\ChiTietGioHang; // Import model ChiTietGioHang để truy cập vào bảng ChiTietGioHang trong database
use Illuminate\Http\Request; // Import Request để sử dụng request từ client
use DB; // Import DB để sử dụng các hàm thao tác database

class GioHangController extends Controller
{


	public function addToCart(Request $request)
	{
		// Kiểm tra người dùng đã đăng nhập hay chưa
		if (!auth()->check()) {
			// Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
			return redirect()->route('DangNhap');
		}

		// Lấy ID sản phẩm từ request
		$productId = $request->input('product_id');
		// Tìm sản phẩm dựa trên ID, sẽ trả về lỗi nếu không tìm thấy
		$sanpham = SanPham::findOrFail($productId);

		// Lấy mã khách hàng từ người dùng đang đăng nhập
		$maKH = auth()->user()->khachhang->MaKH;

		// Tìm hoặc tạo mới giỏ hàng cho khách hàng
		$giohang = GioHang::firstOrCreate(
			['MaKH' => $maKH], // Điều kiện tìm kiếm
			['TongTien' => 0] // Dữ liệu mặc định nếu không tìm thấy giỏ hàng
		);

		// Tìm chi tiết giỏ hàng có sản phẩm tương ứng
		$chitiet = $giohang->chiTietGioHang()->where('MaSP', $sanpham->MaSP)->first();

		// Nếu sản phẩm đã có trong giỏ, tăng số lượng và cập nhật thành tiền
		if ($chitiet) {
			// Lấy số lượng thêm vào từ request
			$additionalQuantity = $request->input('Quantity');
			// Tính số lượng mới
			$newSoLuong = $chitiet->SoLuong + $additionalQuantity;
			// Tính thành tiền mới
			$newThanhTien = $newSoLuong * $sanpham->GiaBan;

			// Lấy mã giỏ hàng và mã sản phẩm
			$maGH = $chitiet->MaGH;
			$maSP = $chitiet->MaSP;

			// Sử dụng DB::table để cập nhật dữ liệu trong bảng chitietgiohang
			DB::table('chitietgiohang')
				->where('MaGH', $maGH) // Điều kiện cập nhật
				->where('MaSP', $maSP) // Điều kiện cập nhật
				->update([
					'SoLuong' => DB::raw('SoLuong + ' . $additionalQuantity), // Cập nhật số lượng
					'ThanhTien' => $newThanhTien // Cập nhật thành tiền
				]);

		} else {
			// Nếu sản phẩm chưa có trong giỏ, thêm mới chi tiết vào giỏ hàng
			$chitiet = new ChiTietGioHang([
				'MaSP' => $sanpham->MaSP, // Mã sản phẩm
				'SoLuong' => $request->input('Quantity'), // Số lượng
				'ThanhTien' => $request->input('Quantity') * $sanpham->GiaBan, // Thành tiền
			]);
			// Lưu chi tiết giỏ hàng vào giỏ hàng
			$giohang->chiTietGioHang()->save($chitiet);
		}

		// Cập nhật tổng tiền giỏ hàng
		$giohang->fresh()->update(['TongTien' => $giohang->chiTietGioHang->sum('ThanhTien')]);

		// Chuyển hướng người dùng đến trang trước đó
		return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công.');
	}

	
	public function updateItem(Request $request, $MaGH, $MaSP)
	{
		// Validate dữ liệu từ request
		$validated = $request->validate([
			'quantity' => 'required|integer|min:1', // Yêu cầu số lượng phải là số nguyên, bắt buộc và lớn hơn hoặc bằng 1
		]);

		// Bắt đầu transaction để đảm bảo tính nhất quán khi thao tác database
		DB::beginTransaction();
		try {
			// Tìm chi tiết giỏ hàng dựa trên mã giỏ hàng và mã sản phẩm
			$item = ChiTietGioHang::where('MaGH', $MaGH)->where('MaSP', $MaSP)->firstOrFail();

			// Kiểm tra xem chi tiết giỏ hàng có tồn tại và thuộc về người dùng đang đăng nhập không
			if ($item && $item->gioHang->MaKH == auth()->user()->khachhang->MaKH) {
				// Cập nhật số lượng và thành tiền
				ChiTietGioHang::where('MaGH', $MaGH)->where('MaSP', $MaSP)->update([
					'SoLuong' => $validated['quantity'], // Số lượng mới
					'ThanhTien' => $validated['quantity'] * $item->sanPham->GiaBan // Thành tiền mới
				]);

				// Lấy lại đối tượng giỏ hàng và cập nhật tổng tiền
				$gioHang = $item->gioHang;
				$gioHang->fresh()->update(['TongTien' => $gioHang->chiTietGioHang->sum('ThanhTien')]);

				// Commit transaction nếu mọi thứ thành công
				DB::commit();
				return redirect()->back()->with('success', 'Số lượng và tổng tiền đã được cập nhật.');
			} else {
				// Rollback transaction nếu có lỗi
				DB::rollBack();
				return redirect()->back()->with('error', 'Không thể cập nhật sản phẩm.');
			}
		} catch (\Exception $e) {
			// Rollback transaction nếu có lỗi
			DB::rollBack();
			return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
		}
	}

	
	public function deleteItem($MaGH, $MaSP)
	{
		// Xóa chi tiết giỏ hàng dựa trên mã giỏ hàng và mã sản phẩm
		$deletedCount = ChiTietGioHang::where('MaGH', $MaGH)->where('MaSP', $MaSP)->delete();

		// Nếu không có hàng nào bị xóa.
		if ($deletedCount === 0) {
			return redirect()->back()->with('error', 'Không thể xóa sản phẩm.');
		}

		// Tìm giỏ hàng để cập nhật tổng số tiền
		$gioHang = GioHang::find($MaGH);

		// Nếu không tìm thấy giỏ hàng
		if ($gioHang == null) {
			return redirect()->back()->with('error', 'Không thể tìm thấy giỏ hàng.');
		}

		// Cập nhật tổng tiền giỏ hàng nếu cần
		$gioHang->fresh()->update(['TongTien' => $gioHang->chiTietGioHang->sum('ThanhTien')]);


		return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
	}
	
	public function getCartCount()
	{
		// Kiểm tra điều kiện xem người dùng đã đăng nhập hay chưa
		if (!auth()->check()) {
			return 0;
		}

		// Lấy mã khách hàng từ người dùng đang đăng nhập
		$maKH = auth()->user()->khachhang->MaKH;
		// Tìm giỏ hàng của khách hàng
		$gioHang = GioHang::where('MaKH', $maKH)->first();

		// Nếu không tìm thấy giỏ hàng
		if (!$gioHang) {
			return 0;
		}

		// Đếm số lượng dòng trong chi tiết giỏ hàng
		return $gioHang->chiTietGioHang->count();
	}
}