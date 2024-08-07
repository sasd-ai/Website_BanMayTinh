<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDatHang;
use App\Models\ChiTietGioHang;
use App\Models\DatHang;
use App\Models\GioHang;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use App\Models\SanPham;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\PayosService;

class ThanhToanController extends Controller
{
	// protected $payosService;

	// public function __construct(PayosService $payosService)
	// {
	//     $this->payosService = $payosService;
	// }
	public function thanhToan(Request $request)
	{

		$khuyenMais = KhuyenMai::all();
		// $paymentData = $this->payosService->createPayment($request->amount, $request->description);

		// $qrCodeUrl = $paymentData['qr_code_url'];
		// Kiểm tra người dùng đã đăng nhập
		if (!auth()->check()) {
			return redirect()->route('DangNhap');
		}

		// Nhận chuỗi các ID sản phẩm đã chọn từ request, đã được ngăn cách bởi dấu phẩy
		$selectedItemsInput = $request->input('selectedItems', '');

		// Chuyển chuỗi thành mảng các ID
		$selectedItems = empty($selectedItemsInput) ? [] : explode(',', $selectedItemsInput);
		session(['selectedItems' => $selectedItems]);

		// Kiểm tra nếu không có sản phẩm nào được chọn, gửi thông báo lỗi
		if (empty($selectedItems)) {
			return redirect()->route('UserInformation')->with('error', 'Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
		} else {
			// Lấy thông tin giỏ hàng của người dùng
			$maKH = auth()->user()->khachhang->MaKH;
			$giohang = GioHang::where('MaKH', $maKH)
				->with([
					'chiTietGioHang' => function ($query) use ($selectedItems) {
						// Nạp eager loading cho mối quan hệ sanPham chỉ đối với các sản phẩm được chọn.
						$query->whereIn('MaSP', $selectedItems)
							->with('sanPham');
					}
				])->firstOrFail();

			$chitietgiohang = $giohang->chiTietGioHang; // Đây giờ nên là collection các item được chọn

			// Tính tổng tiền của các sản phẩm được chọn
			$tongTien = $chitietgiohang->reduce(function ($total, $chiTiet) {
				if ($chiTiet->sanPham) {
					return $total + ($chiTiet->sanPham->GiaBan * $chiTiet->SoLuong);
				}

				return $total;
			}, 0);
			session(['tongTien' => $tongTien]);
			$tongTien1 = $chitietgiohang->reduce(function ($total, $chiTiet) {
				if ($chiTiet->sanPham) {
					return $total + ($chiTiet->sanPham->GiaBan * $chiTiet->SoLuong);
				}

				return $total;
			}, 0);

			return view('ThanhToan.ThanhToan', compact('chitietgiohang', 'tongTien', 'tongTien1', 'khuyenMais', ));
		}
	}
	public function payment(Request $request)
{
    $khachHang = auth()->user()->khachhang;
    $maKH = auth()->user()->khachhang->MaKH;

    // Lấy giỏ hàng của người dùng đang đăng nhập
    $gioHang = GioHang::where('MaKH', $khachHang->MaKH)->firstOrFail();

    $selectedProductIds = session('selectedItems');

    // Thực hiện các thao tác tiếp theo với danh sách sản phẩm được chọn
    $chiTietGioHang = ChiTietGioHang::where('MaGH', $gioHang->MaGH)
        ->whereIn('MaSP', $selectedProductIds)
        ->with('sanPham')
        ->get();
    $tongTien = session('tongTien');

    // Tạo và lưu đơn đặt hàng
    $maKM = $request->khuyenMai;
    $khuyenMai = KhuyenMai::find($maKM);
    $tienKM = $khuyenMai ? $khuyenMai->GiaTri : 0;
	$tttt='Chưa Thanh Toán';
	$ttdh='Chờ Xác Nhận Đơn';
    //$ntt='2020-06-01 21:49:47';

    $datHang = DatHang::create([
        'MaKH' => $maKH,
        'MaKM' => $maKM,
        'TongTien' => $tongTien,
        'TienKM' => $tienKM,
        'ThanhTien' => $tongTien - $tienKM,
        'GhiChu' => $request->note,
        'DiaChi' => $request->addressReceive,
        'TenKH' => $request->customerNameReceive,
        'SDT' => $request->phoneReceive,
        'NgayDatHang' => Carbon::now('Asia/Ho_Chi_Minh'),
       // 'NgayDatHang' => $ntt,
		'TinhTrang_TT'=>$tttt,
		'TinhTrang_DH'=>$ttdh,
    ]);

    if ($datHang) {
        // Sử dụng transaction để đảm bảo tính nhất quán
        DB::transaction(function () use ($datHang, $chiTietGioHang) {
            foreach ($chiTietGioHang as $item) {
                // Kiểm tra xem mục đã tồn tại chưa
                $existingEntry = ChiTietDatHang::where('MaDH', $datHang->MaDH)
                    ->where('MaSP', $item->MaSP)
                    ->first();

                if ($existingEntry) {
                    // Cập nhật mục đã tồn tại
                    $existingEntry->SoLuong += $item->SoLuong;
                    $existingEntry->ThanhTien += $item->SoLuong * $item->sanPham->GiaBan;
                    $existingEntry->save();
                } else {
                    // Tạo mục mới
                    $newChiTietDatHang = ChiTietDatHang::create([
                        'MaDH' => $datHang->MaDH,
                        'MaSP' => $item->MaSP,
                        'SoLuong' => $item->SoLuong,
                        'ThanhTien' => $item->SoLuong * $item->sanPham->GiaBan,
                    ]);

                    // Gọi stored procedure sau khi thêm dữ liệu
                    DB::connection('mysql')->statement("CALL UpdateTinhTrangBHProc('{$datHang->MaDH}', '{$item->MaSP}')");
                }
            }
        });

        ChiTietGioHang::where('MaGH', $gioHang->MaGH)
            ->whereIn('MaSP', $selectedProductIds)->delete();

        return redirect('/')->with('success', 'Đơn hàng của bạn đã được đặt thành công.');
    } else {
        return redirect('/')->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }
}


public function HuyDonHang(Request $request)
{
    // Xác thực dữ liệu yêu cầu
    $request->validate([
        'mahuy' => 'required|exists:dathang,MaDH', // Đảm bảo mahuy có giá trị và tồn tại trong bảng dathang
        'reason' => 'required|string', // Đảm bảo lý do hủy đơn hàng có giá trị và là chuỗi
        'otherReason' => 'nullable|string' // Lý do khác là tùy chọn và là chuỗi
    ]);

    // Tìm đơn hàng theo ID
    $order = DatHang::find($request->input('mahuy'));

    // Kiểm tra nếu trạng thái đơn hàng là 'Chờ Xác Nhận Đơn'
    if ($order->TinhTrang_DH === 'Chờ Xác Nhận Đơn') {
        // Cập nhật trạng thái đơn hàng thành 'Chờ Xác Nhận Hủy Đơn Hàng'
        $order->TinhTrang_DH = 'Chờ Xác Nhận Hủy Đơn Hàng';

        // Lấy lý do hủy từ yêu cầu
        $reason = $request->input('reason');
        $otherReason = $request->input('otherReason');

        // Tạo nội dung ghi chú
        if ($reason === 'Lý do khác' && !empty($otherReason)) {
            $note = "Lý do hủy đơn hàng: " . $otherReason;
        } else {
            $note = "Lý do hủy đơn hàng: " . $reason;
        }

        // Lưu ghi chú vào đơn hàng
        $order->GhiChu = $note;

        // Lưu thay đổi vào cơ sở dữ liệu
        $order->save();

        // Chuyển hướng về trang trước và hiển thị thông báo thành công
        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    // Nếu không thể hủy đơn hàng, chuyển hướng về trang trước và hiển thị thông báo lỗi
    return redirect()->back()->with('error', 'Không thể hủy đơn hàng.');
}



//     BEGIN
//     -- Khai báo các biến 
//     DECLARE TGBaoHanh INT; -- Biến lưu trữ thời gian bảo hành (tính theo tháng)
//     DECLARE NgayHoaDon DATE; -- Biến lưu trữ ngày đặt hàng
//     DECLARE ThoiGianBaoHanhTinhDenNgay DATE; -- Biến lưu trữ ngày hết hạn bảo hành
//     DECLARE TinhTrang VARCHAR(255); -- Biến lưu trữ trạng thái bảo hành

//     -- Lấy thông tin bảo hành từ các bảng liên quan
//     SELECT sp.Tg_BaoHanh, dh.NgayDatHang -- Lấy thời gian bảo hành từ bảng sanpham và ngày đặt hàng từ bảng dathang
//     INTO TGBaoHanh, NgayHoaDon -- Gán giá trị vào các biến TGBaoHanh và NgayHoaDon
//     FROM sanpham sp 
//     JOIN dathang dh ON sp.MaSP = p_MaSP AND dh.MaDH = p_MaDH; -- Nối 2 bảng dựa vào mã sản phẩm và mã đặt hàng

//     -- Tính ngày hết hạn bảo hành
//     SET ThoiGianBaoHanhTinhDenNgay = DATE_ADD(NgayHoaDon, INTERVAL TGBaoHanh MONTH); -- Thêm thời gian bảo hành vào ngày đặt hàng để tính ngày hết hạn

//     -- Xác định trạng thái bảo hành
//     IF NOW() <= ThoiGianBaoHanhTinhDenNgay THEN -- Kiểm tra xem ngày hiện tại có nhỏ hơn hoặc bằng ngày hết hạn bảo hành hay không
//         SET TinhTrang = CONCAT('Còn bảo hành đến ngày ', DATE_FORMAT(ThoiGianBaoHanhTinhDenNgay, '%Y-%m-%d')); -- Nếu còn bảo hành, gán trạng thái là 'Còn bảo hành đến ngày...'
//     ELSE
//         SET TinhTrang = CONCAT('Hết bảo hành từ ngày ', DATE_FORMAT(ThoiGianBaoHanhTinhDenNgay, '%Y-%m-%d')); -- Nếu hết bảo hành, gán trạng thái là 'Hết bảo hành từ ngày...'
//     END IF;

//     -- Cập nhật trạng thái bảo hành vào bảng chitietdathang
//     UPDATE chitietdathang 
//     SET TinhTrang_BH = TinhTrang -- Cập nhật cột TinhTrang_BH trong bảng chitietdathang bằng giá trị của biến TinhTrang
//     WHERE MaDH = p_MaDH AND MaSP = p_MaSP; -- Điều kiện cập nhật: mã đặt hàng và mã sản phẩm phải khớp với các tham số truyền vào

// END

}
