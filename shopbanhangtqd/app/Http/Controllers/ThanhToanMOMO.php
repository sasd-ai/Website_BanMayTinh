<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\ChiTietDatHang;
use App\Models\ChiTietGioHang;
use App\Models\DatHang;
use App\Models\GioHang;
use App\Models\KhuyenMai;
use App\Models\SanPham;
use DB;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Mail;




class ThanhToanMOMO extends Controller
{

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
  
    public function momo_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $khachHang = auth()->user()->khachhang;
        $maKH = $khachHang->MaKH;
       

        // Lấy giỏ hàng của người dùng đang đăng nhập
        $gioHang = GioHang::where('MaKH', $maKH)->firstOrFail();

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
       
        $ThanhTienThanhToan = $tongTien - $tienKM;

        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toán qua MoMo";
        $amount  = (string) $ThanhTienThanhToan;
        $orderId = time() . "";
        $returnUrl = route('payment.success');
        $notifyUrl = route('payment.notify');
        $bankCode = "SML";
        
        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";
        
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyUrl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data = array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $tttt = 'Đã Thanh Toán';
        $ttdh = 'Đã Xác Nhận Đơn';
      
        $datHang = DatHang::create([
            'MaKH' => $maKH,
            'MaKM' => $maKM,
            'TongTien' => $tongTien,
            'TienKM' => $tienKM,
            'ThanhTien' => $ThanhTienThanhToan,
            'GhiChu' => $request->note,
            'DiaChi' => $request->addressReceive,
            'TenKH' => $request->customerNameReceive,
            'SDT' => $request->phoneReceive,
            //  'NgayDatHang' => '2020-05-05 10:10:10',
             'NgayDatHang' => Carbon::now('Asia/Ho_Chi_Minh'),
            'TinhTrang_TT' => $tttt,
            'TinhTrang_DH' => $ttdh,
        ]);

        if ($datHang) {
            // Sử dụng transaction để đảm bảo tính nhất quán
            DB::transaction(function () use ($datHang, $chiTietGioHang) {
                foreach ($chiTietGioHang as $item) {
                    // Tạo mục chi tiết đặt hàng mới
                    ChiTietDatHang::create([
                        'MaDH' => $datHang->MaDH,
                        'MaSP' => $item->MaSP,
                        'SoLuong' => $item->SoLuong,
                        'ThanhTien' => $item->SoLuong * $item->sanPham->GiaBan,
                    ]);

                    // Gọi stored procedure sau khi thêm dữ liệu
                    DB::connection('mysql')->statement("CALL UpdateTinhTrangBHProc('{$datHang->MaDH}', '{$item->MaSP}')");
                }
            });

            // Xóa các mục khỏi giỏ hàng sau khi đã tạo đơn hàng
            ChiTietGioHang::where('MaGH', $gioHang->MaGH)
                ->whereIn('MaSP', $selectedProductIds)->delete();

            // Gửi yêu cầu thanh toán đến MOMO
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            
            error_log(print_r($jsonResult, true));
            $orderDetails = ChiTietDatHang::where('MaDH', $datHang->MaDH)
            ->with('sanPham')
            ->get();
            // Gửi email xác nhận
          // Trong hàm sendOrderConfirmationEmail:
          $this->SendMailKhachHang($maKH, $datHang->MaDH, $orderDetails);

            return redirect($jsonResult['payUrl']);
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Xử lý logic sau khi thanh toán thành công
        $transactionID = $request->input('transId'); // Hoặc tên tham số trả về từ MOMO
        $orderID = $request->input('orderId');

        $datHang = DatHang::where('transaction_id', $transactionID)->orWhere('MaDH', $orderID)->first();
        if ($datHang) {
            $datHang->TinhTrang_TT = 'Đã thanh toán';
            $datHang->save();
        }

        return redirect('/')->with('success', 'Đơn hàng của bạn đã được thanh toán thành công');
    }

    public function paymentNotify(Request $request)
    {
        // Xử lý thông báo từ MOMO
        $transactionID = $request->input('transId'); // Hoặc tên tham số trả về từ MOMO
        $orderID = $request->input('orderId');
        $resultCode = $request->input('resultCode'); // Kết quả giao dịch

        if ($resultCode == '0') {
            // Giao dịch thành công
            $datHang = DatHang::where('transaction_id', $transactionID)->orWhere('MaDH', $orderID)->first();
            if ($datHang) {
                $datHang->TinhTrang_TT = 'Đã thanh toán';
                $datHang->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

    private function SendMailKhachHang($maKH, $maDH, $orderDetails)
{
    $khachHang = auth()->user()->khachhang;
    $maKH = $khachHang->MaKH;
    $toEmail = $khachHang->Email;

    // Lấy thông tin đơn hàng
    $datHang = DatHang::where('MaDH', $maDH)
    ->whereNotNull('MaDH') // Thêm điều kiện kiểm tra MaDH không phải null
    ->first();

    // Lấy chi tiết đơn hàng hiện tại
    $orderDetails = ChiTietDatHang::where('MaDH', $maDH)
        ->with('sanPham')
        ->get();

    // Gửi email
    Mail::to($toEmail)
        ->send(new SendMail($maDH, $orderDetails, $datHang));
}
}
